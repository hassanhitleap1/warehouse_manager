<?php


use app\controllers\BaseController;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\orders\OrderForm;
use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;
use app\models\products\Products;
use app\models\regions\Regions;
use app\models\users\Users;
use Carbon\Carbon;
use yii\filters\VerbFilter;

class FastOrderController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex($id){
        $modelOrder= new OrderForm();
        return $this->renderAjax('faster_order',[
            'model' => Products::findOne($id),
            'modelOrder'=>$modelOrder
        ]);
    }


    public function actionSaveOrder($id){
        $modelOrder= new OrderForm();
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if ($modelOrder->load(Yii::$app->request->post()) && $modelOrder->validate()) {

                $product=Products::findOne($id);
                $next_order=Orders::find()->max('id') + 1;
                $region=Regions::findOne($modelOrder->region_id);
                $typeoption=OptionsSellProduct::findOne($modelOrder->typeoption);
                $today=Carbon::now("Asia/Amman");
                $delivery_price=$region->price_delivery;
                $discount=($typeoption->number *$product->selling_price) - $typeoption->price;
                $profit_margin= $typeoption->price  -  ($product->purchasing_price * $typeoption->number) ;
                $order_model=new Orders;
                $order_model->order_id = (string) $next_order;
                $order_model->delivery_time=$today->addDay(1);
                $order_model->country_id=1;
                $order_model->region_id=$modelOrder->region_id;
                $order_model->phone=$modelOrder->phone;
                $order_model->name=$modelOrder->name;
                $order_model->other_phone=$modelOrder->other_phone;
                $order_model->address=is_null($modelOrder->address)?$region->name_ar:$modelOrder->address;
                $order_model->status_id=1;
                $order_model->delivery_price =$delivery_price;
                $order_model->discount= $discount;
                $order_model->total_price=$delivery_price+$typeoption->price;
                $order_model->profit_margin=  $profit_margin ;
                $order_model->amount_required=$order_model->total_price-$delivery_price;
                $transaction = \Yii::$app->db->beginTransaction();
                if ($order_model->save()) {
                    $userModel = Users::find()->where(['phone'=> $modelOrder->phone])->one();
                    if(is_null($userModel)){
                        $userModel= new Users();
                    }
                    $user=$this->set_value_user($userModel,$order_model);
                    $user->save();
                    $orderItemModel=new OrdersItem;
                    $orderItemModel->order_id = $order_model->id;
                    $orderItemModel->product_id=$id;
                    $orderItemModel->sub_product_id=$modelOrder->type;
                    $orderItemModel->price=$product->selling_price;
                    $orderItemModel->price_item_count=$typeoption->price ;
                    $orderItemModel->profits_margin=$profit_margin * $typeoption->number;
                    $orderItemModel->profit_margin=$profit_margin;
                    $orderItemModel->quantity=$typeoption->number ;
                    $order_model->user_id=$user->id;
                    $order_model->save(false);

                    if($orderItemModel->save()){
                        $transaction->commit();
                        return [
                            'data' => [
                                'success' => true,
                                'model' => $order_model,
                                'message' => 'Model has been saved.',
                            ],
                            'code' => 0,
                        ];
                    }else{
                        return [
                            'data' => [
                                'success' => false,
                                'model' => null,
                                'message' => 'An error occured.',
                            ],
                            'code' => 1, // Some semantic codes that you know them for yourself
                        ];
                    }
                }

                return [
                    'data' => [
                        'success' => true,
                        'model' => $order_model,
                        'message' => 'Model has been saved.',
                    ],
                    'code' => 0,
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'model' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1, // Some semantic codes that you know them for yourself
                ];
            }
        }
    }

    private function set_value_user($user ,$model){
        $user->phone = $model->phone;
        $user->other_phone = $model->other_phone;
        $user->name = $model->name;;
        $user->country_id = ($model->country_id !='') ? $model->country_id :null  ;
        $user->region_id = ($model->region_id !='') ? $model->region_id :null  ;
        $user->area_id = ($model->area_id !='') ? $model->area_id :null  ;
        $user->address =($model->address !='') ? $model->address :null  ;
        $user->username=null;
        $user->email =null;
        $user->auth_key =null;
        $user->name_in_facebook = ($model->name_in_facebook !='') ? $model->name_in_facebook :null  ; $model->name_in_facebook;
        $user->password_hash =null;
        $user->password_reset_token =null;
        // $user->created_at=null;
        // $user->updated_at=null;

        return $user;
    }
    
}