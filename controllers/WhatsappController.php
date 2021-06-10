<?php


namespace app\controllers;


use app\models\orders\Orders;
use Yii;
use yii\web\Controller;

class WhatsappController extends Controller
{
        public $enableCsrfValidation = false;

//        public function behaviors()
//        {
//            $behaviors = parent::behaviors();
//            $behaviors['corsFilter'] = [
//                'class' => \yii\filters\Cors::className(),
//                'cors' => [
//                    'Origin'                           => "*",
//                    'Access-Control-Request-Method'    => ['POST', 'GET'],
//                    'Access-Control-Allow-Credentials' => true,
//                    'Access-Control-Max-Age'           => 3600,
//                ],
//            ];
//
//            return $behaviors;
//        }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => "*",
                'Access-Control-Request-Method'    => ['POST', 'GET'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,
            ],
        ];
        return $behaviors;
    }

        public function actionGet(){
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $string_id=$_GET['string_id'];
            $ides = explode(",", $string_id);
            $data=[];
            $orders=Orders::find()->where(['in','id',$ides])->all();
            foreach ($orders as $key => $order){
                $orderItemString = '';
                foreach ($order->orderItems as $orderItem) {
                    $type = '';
                    if (isset($orderItem->product->subProductCount)&& count($orderItem->product->subProductCount) > 1) {
                        $type = $orderItem->subProduct->type;
                    }
                    $orderItemString .= ' ' . $orderItem['product']['name'] . ' ' . $type . ' ' . Yii::t('app', 'Number') . ' ( ' . $orderItem->quantity . ' ) </br>';
                }

                $data[]=[
                    'order_str'=>$orderItemString,
                    'phone'=> $order['user']['phone'],
                    'name'=>$order['user']['name'],
                ];

            }

            return ['code'=>201,'data'=>$data];
        }
}