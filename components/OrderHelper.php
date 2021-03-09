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
       
        $ordersItem= $model->orderItems;

            if($model->status_id != $status_id){
                if($status_id <= 3){
                    if($model->status_id== 4 || $model->status_id == 5 || $model->status_id == 8){
                        self::stock_minus($ordersItem);
                    }
                }elseif($status_id==4 || $status_id==5){
                    if($model->status_id <= 3 || $model->status_id = 6){
                        self::stock_plus($ordersItem);
                    }
                }elseif($status_id==8){
                    if($model->status_id== 4 || $model->status_id == 5 || $model->status_id ==6 || $model->status_id ==7){
                        self::stock_plus($ordersItem); 
                    }
                    
                }
            }

            $model->status_id=$status_id;
            $model->save(false);    

   }    




   public static function stock_plus($ordersItem){
        foreach ($ordersItem as $orderItem) {
            $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
            $orderItemModel->count=$orderItemModel->count+$orderItem->quantity;
            $orderItemModel->save();
            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
            $productModel->quantity=$productModel->quantity+$orderItem->quantity;
            $productModel->save();
        }
   }

   public static function stock_minus($ordersItem){
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
