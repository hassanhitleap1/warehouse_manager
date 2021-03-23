<?php

namespace app\controllers;

use app\models\orders\OrderForm;
use Yii;
use app\models\products\Products;
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
        
        if ($modelOrder->load(Yii::$app->request->post())) {
          $product=Products::findOne($id);
          $next_order=Orders::find()->max('id') + 1;
          $order_model=new Orders;
          $order_model->order_id= $next_order;
          $today=Carbon::now("Asia/Amman");
          $order_model->delivery_time=$today->toTimeString();
          $order_model->country_id=1;
          $order_model->region_id=$modelOrder->region_id;
          $order_model->address=$modelOrder->address;
          $order_model->status_id=1
          $order_model->delivery_price =2;
          $order_model=discount=0;
          
          $order_model->total_price =$_POST['total_price']
          $order_model->profit_margin=  $_POST['total_price'] - ($product->purchasing_price * $_POST[count'])  
        $order_model->amount_required=$_POST['total_price'];
        
          

        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelOrder'=>$modelOrder
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
        $user->created_at=null;
        $user->updated_at=null;

        return $user;
    }
}
