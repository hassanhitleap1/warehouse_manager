<?php

namespace  app\components;

use app\models\pricecompanydelivery\PriceCompanyDelivery;
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
                
                switch($model->status_id){
  
                    case 2: 
                        //  don't any things 
                        switch($status_id){
                            case 3 : case 4 : 
                                self::stock_minus($ordersItem);
                                break;
                        }
                       break; 

                    case 3 :
                        switch($status_id){
                            case 6 : 
                                self::stock_plus($ordersItem);
                                break;
                        }
                        break;  
                        
                    case 7 :
                        switch($status_id){
                            case 13 : 
                                self::stock_plus($ordersItem);
                                break;
                        } 
                        break;   
                    case 8 :
                        switch($status_id){
                                case 6 : 
                                    self::stock_plus($ordersItem);
                                    break;
                            } 
                        break; 
                    case 9 :
                        //  don't any things 
                        break; 
                    case 10 :
                        switch($status_id){
                            case 3 : 
                                self::stock_minus($ordersItem);
                                break;
                        } 
                        break;  
                    case 11 :
                        switch($status_id){
                            case 13 : 
                                self::stock_plus($ordersItem);
                                break;
                            } 
                        break; 
                                                          
                }

            }

            $model->status_id=$status_id;
            $model->save(false);    

   }    


   public static function get_discount($typeoption,$product){
       return ($typeoption->number *$product->selling_price) - $typeoption->price;
   }

    public static function profit_margin($typeoption,$product){
     return $typeoption->price  -  ($product->purchasing_price * $typeoption->number) ;
    }

    public static function delivery_price($region,$product){
        if(! is_null($product->company_delivery_id)){
            
            $model_del=PriceCompanyDelivery::find()
                ->where(['=','company_delivery_id',$product->company_delivery_id])
                ->andWhere(['=','region_id',$region->id])->one();
               
            if(is_null($model_del)){
                $delivery_price=$region->price_delivery;
            }else{
                $delivery_price=$model_del->price;
                
            }
        
        }else{
            $delivery_price=$region->price_delivery;
        }


        return $delivery_price;
        
    }
    

    public static function set_value_user($user ,$model){
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
    
    public static function amount_required($order_model, $delivery_price){
        return $order_model->total_price-$delivery_price;
    }

   public static function stock_plus($ordersItem){
        foreach ($ordersItem as $orderItem) {
            // $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
            // $orderItemModel->count=$orderItemModel->count+$orderItem->quantity;
            // $orderItemModel->save();
            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
            $productModel->quantity=$productModel->quantity+$orderItem->quantity;
            $sub_product_count=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
            $sub_product_count->count= (int)$sub_product_count->count + (int) $orderItem->quantity;
            $sub_product_count->save();
            $productModel->save();
        }

   }

   public static function stock_minus($ordersItem){
        foreach ($ordersItem as $orderItem) {
            // $orderItemModel=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
            // $orderItemModel->count=$orderItemModel->count-$orderItem->quantity;
            // $orderItemModel->save();
            $productModel=Products::find()->where(['id'=>$orderItem->product_id])->one();
            $productModel->quantity=$productModel->quantity-$orderItem->quantity;
            $sub_product_count=SubProductCount::find()->where(['id'=>$orderItem->sub_product_id])->one();
            $sub_product_count->count=(int) $sub_product_count->count - (int) $orderItem->quantity;
            $sub_product_count->save();
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
                $status=Status::find()->where(['in', 'id', [4,6] ])->all();
            break; 
            case 4: //  قيد التوصيل
                $status=Status::find()->where(['in', 'id', [5,7,9,11] ])->all();
            break;  
            
            case 5: // تم توصيله
                $status=Status::find()->where(['in', 'id', [12] ])->all();
            break; 
            case 6: // ملغي من الشركة
                $status=Status::find()->all();
            break; 
            case 7: // ملغي من الشركة
                $status=Status::find()->where(['in', 'id', [13] ])->all();
            break;     
            case 8: // مؤجل
                $status=Status::find()->where(['in', 'id', [4,6] ])->all();
            break; 
            case 9: // مؤجل من الشركة
                $status=Status::find()->where(['in', 'id', [5,7,11] ])->all();
            break; 
            case 10: // لا يرد
                $status=Status::find()->where(['in', 'id', [2,3,6] ])->all();
            break; 
            case 11: // لا يرد
                $status=Status::find()->where(['in', 'id', [5,7,13] ])->all();
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
