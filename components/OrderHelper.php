<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;
use app\models\subproductcount\SubProductCount;
use app\models\products\Products;


class OrderHelper extends BaseObject
{

   public static function management_stock_product($model,$status_id){
       
        $ordersItem= $model->orderItems;
           
            if($model->status_id != $status_id ){
                switch ($status_id) {
                    case 1: 
                        switch ($model->status_id) {
                            case 2:  case 3: case 4:  case 7: 
                                self::stock_minus($ordersItem);
                            break;   
                        }    
                    break;
                    case 2: 
                        switch ($model->status_id) {
                            case 1:  case 8:  
                                self::stock_plus($ordersItem);
                                break;   
                        } 

                         break;   

                    case 3: case 4:   case 5:   case 6:   case 7: 
                        switch ($model->status_id) {
                             case 8: 
                                self::stock_minus($ordersItem);
                                break;   
                        } 
                        break;   
                    case 8: 
                        switch ($model->status_id) {
                            case 2: case 3: case 4: 
                               self::stock_minus($ordersItem);
                               break;   
                       }

                        break; 
                      
                    
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
