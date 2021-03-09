<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;
use app\models\subproductcount\SubProductCount;
use app\models\products\Products;
use app\models\ordersitem\OrdersItem;
use yii\helpers\ArrayHelper;

class OrderHelper extends BaseObject
{

   public static function management_stock_product($model,$status_id){

            switch ($status_id) {
                case 1: case 2: case 3:  
                    if($model->status_id==4){
                        $ordersItem= $model->orderItems;
                        foreach ($ordersItem as $orderItem) {
                            $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                            $orderItemModel->count=$orderItemModel->count-$orderItem->quantity;
                            $orderItemModel->save();
                            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
                            $productModel->quantity=$productModel->quantity-$orderItem->quantity;
                            $productModel->save();
                        }
                    }
                case 4:
                    if($model->status_id <= 3){
                        $ordersItem= $model->orderItems;
                        foreach ($ordersItem as $orderItem) {
                            $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                            $orderItemModel->count=$orderItemModel->count+$orderItem->quantity;
                            $orderItemModel->save();
                            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
                            $productModel->quantity=$productModel->quantity+$orderItem->quantity;
                            $productModel->save();
                        } 
                    }elseif($model->status_id==6 || $model->status_id==7 ){
                        $ordersItem= $model->orderItems;
                        foreach ($ordersItem as $orderItem) {
                            $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                            $orderItemModel->count=$orderItemModel->count+$orderItem->quantity;
                            $orderItemModel->save();
                            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
                            $productModel->quantity=$productModel->quantity+$orderItem->quantity;
                            $productModel->save();
                        }
                    }
                    
                case 6: case 7:
                    if($model->status_id==4){
                        $ordersItem= $model->orderItems;
                        foreach ($ordersItem as $orderItem) {
                            $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
                            $orderItemModel->count=$orderItemModel->count-$orderItem->quantity;
                            $orderItemModel->save();
                            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
                            $productModel->quantity=$productModel->quantity-$orderItem->quantity;
                            $productModel->save();
                        }
                    }                   
                }

   }



}
