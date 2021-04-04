<?php

namespace app\controllers;

use app\components\OrderHelper;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\orders\OrderForm;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\users\Users;
use Carbon\Carbon;
use Yii;
use app\models\products\Products;
use app\models\regions\Regions;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class ProductController extends Controller
{
  

    /**
     * Displays a single Area model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelOrder= new OrderForm();
        $product_suggested=Products::find()->where(['!=','id',$id])->limit(4)->all();
        if ($modelOrder->load(Yii::$app->request->post())) {
            $product=Products::findOne($id);
            $next_order=Orders::find()->max('id') + 1;
            $region=Regions::findOne($modelOrder->region_id);
            $typeoption=OptionsSellProduct::findOne($modelOrder->typeoption);
            $today=Carbon::now("Asia/Amman");
            $delivery_price=$region->price_delivery;
            $discount=($typeoption->number *$product->selling_price) - $typeoption->price;
            $profit_margin= $typeoption->price-($typeoption->number *$product->purchasing_price) ;
            $order_model=new Orders;
            $order_model->order_id = (string) $next_order;
            $order_model->delivery_time=$today->addDay(1);
            $order_model->country_id=1;
            $order_model->region_id=$modelOrder->region_id;
            $order_model->phone=$modelOrder->phone;
            $order_model->name=$modelOrder->name;
            $order_model->other_phone=$modelOrder->other_phone;
            $order_model->address=is_null($modelOrder->address)?$region->name_ar:$modelOrder->address;
            $order_model->status_id=Products::To_Be_Equipped;
            $order_model->delivery_price =$delivery_price;
            $order_model->discount= $discount;
            $order_model->total_price=$delivery_price+$typeoption->price;
    
            $order_model->profit_margin=  $profit_margin;
            $order_model->amount_required=$order_model->total_price-$delivery_price-$discount;

            
            $transaction = \Yii::$app->db->beginTransaction();

            if ($flag = $order_model->save()) {
                $user = Users::find()->where(['phone'=> $modelOrder->phone])->one();
                if(is_null($user)){
                    $user= new Users();
                }    
                $user=$this->set_value_user($user,$order_model);
                $orderItemModel=new OrdersItem;
                $orderItemModel->order_id = $order_model->id;
                $orderItemModel->product_id=$id;
                $orderItemModel->sub_product_id=$modelOrder->type;
                $orderItemModel->price=$product->selling_price;
                $orderItemModel->price_item_count=$product->selling_price * $typeoption->number ;
                $orderItemModel->profits_margin=$profit_margin;
                $orderItemModel->quantity=$typeoption->number ;
                $order_model->user_id=$user->id;
                if(($user->save() && $orderItemModel->save() && $order_model->save())){
                    $transaction->commit();
                    
                    return $this->render('success', [
                        'model' => $order_model,
                        'product_suggested'=>$product_suggested
            
                    ]);
                  //  Yii::$app->session->set('message', Yii::t('app', 'Successful_Purchase'));
                }else{
                    Yii::$app->session->set('message', Yii::t('app', 'Error'));
                    $transaction->rollBack();
                }

            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelOrder'=>$modelOrder,
            'product_suggested'=>$product_suggested

        ]);
    }



    /**
     * Finds the Area model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Area the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    private function set_value_user($user ,$model){
        $user->phone = $model->phone;
        $user->other_phone = $model->other_phone;
        $user->name = $model->name;;
        $user->country_id = ($model->country_id !='') ? $model->country_id :null  ;
        $user->region_id = ($model->region_id !='') ? $model->region_id :null  ;
        $user->area_id = ($model->area_id !='') ? $model->area_id :null  ;
        $user->address = $model->address;
        $user->username=null;
        $user->email =null;
        $user->auth_key =null;
        $user->name_in_facebook =$model->name_in_facebook;
        $user->password_hash =null;
        $user->password_reset_token =null;
        // $user->created_at=null;
        // $user->updated_at=null;

        return $user;
    }



    public function actionLoadMore(){  
        $query =    Products::find();
        $countQuery = clone $query;
        $page=$_GET['page'];
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $offset= ($page-1) *$pages->limit;
        $models = $query->offset($offset)
            ->limit($pages->limit)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
            ])
            ->all();

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $models;
    }


}
