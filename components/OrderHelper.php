<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;
use app\models\subproductcount\SubProductCount;
use app\models\products\Products;
use app\models\status\Status;

class OrderHelper extends BaseObject
{

   public static function management_stock_product($model,$status_id){
       
        $ordersItem= $model->orderItems;
           
            if($model->status_id != $status_id ){
                switch ($status_id) {
                    case 1: 
                        switch ($model->status_id) {
                            case
                             2:  case 3: case 4:  case 7: 
                                self::stock_minus($ordersItem);
                            break;   
                        }    
                    break;
                    case 2: 
                        switch ($model->status_id) {
                            case 8:  
                                self::stock_plus($ordersItem);
                                break;  
                            case 1:   
                                self::stock_minus($ordersItem);
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
                        case 9:   
                            switch ($model->status_id) {
                                case 2: case 3: case 4: 
                                   self::stock_minus($ordersItem);
                                   break;   
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


    public static function faTOen($string) {
        return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }


    public static function get_status($status_id){
        switch ($status_id) {
            case 1: //  اجراء مكالمة
                $status=Status::find()->where(['in', 'id', [2,6,10] ])->all();
            break;  
            case 2: //  مطلوب تجهيزه
                $status=Status::find()->where(['in', 'id', [3,4,6,8] ])->all();
            break;  
            case 3: //  تم تجهيزه
                $status=Status::find()->where(['in', 'id', [4,6,10] ])->all();
            break; 
            case 4: //  قيد التوصيل
                $status=Status::find()->where(['in', 'id', [5,7,9,11] ])->all();
            break;  
            
            case 5: // تم توصيله
                $status=Status::find()->where(['in', 'id', [12] ])->all();
            break; 
            case 6: // ملغي من الشركة
                $status=Status::find()->where(['in', 'id', [13] ])->all();
            break;   
            case 8: // مؤجل
                $status=Status::find()->where(['in', 'id', [4] ])->all();
            break; 
            case 9: // مؤجل من الشركة
                $status=Status::find()->where(['in', 'id', [5,7,10] ])->all();
            break; 
            case 10: // لا يرد
                $status=Status::find()->where(['in', 'id', [2,6] ])->all();
            break; 
            case 11: // لا يرد
                $status=Status::find()->where(['in', 'id', [13] ])->all();
            break; 
            case 12: // تم استلام المبلغ
                $status=Status::find()->all();
            break; 
            case 13: // تم استلام الطلب الملغي
                $status=Status::find()->all();
            break;
            default : 
             $status=Status::find()->all();

        }  
        return $status;
    }
   
}
