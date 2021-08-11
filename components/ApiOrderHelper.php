<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;


class ApiOrderHelper extends BaseObject
{

   public  function push_orders($models){
       $array_pushed=[];
       foreach ($models as $model){
           $array_pushed[]=[
               "order_id"=>$model['order_id'],
               "name"=>$model['user']['name'],
               'phone'=>$model['user']['phone'] ,
             "region"=>$model['region']['name_ar'],
             "area"=>$model['region']['name_ar'],
             "smaplearea"=>$model['region']['name_ar'],
               'address'=>$model['user']['address'] ,
               'amount'=>$model['total_price'],

           ];
       }


       $request_headers = array(
           "X-Mashape-Key:" . "params",
           "X-Mashape-Host:" . "houst"
       );


       $ch = curl_init('http://www.example.com');
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $array_pushed);

       $response = curl_exec($ch);
       curl_close($ch);

       var_dump($response);
    }
   
}
