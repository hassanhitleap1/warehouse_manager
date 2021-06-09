<?php


namespace app\controllers;


use app\models\orders\Orders;
use app\models\ordersitem\OrdersItem;

class WhatsappController
{
        public function actionGetMassges(){
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

                $data[$key]=[
                    'order_str'=>$orderItemString,
                    'phone'=> $order['user']['phone'],
                    'name'=>$order['user']['name'],
                ];
            }
            return ['code'=>201,'data'=>$data];
        }
}