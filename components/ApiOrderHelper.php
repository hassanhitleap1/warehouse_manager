<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;


class ApiOrderHelper extends BaseObject
{

   public  function push_orders($models){
       $pkg=[];
       $destinationAddress=[
           "addressLine1" => "عين منجد", //required
            "cityId"=> 1, //required
            "villageId"=> 38, //required
            "regionId"=> 1, //required
            "country"=> "Jordan" //required
       ];
       $pkgUnitType="METRIC";
       $originAddress=[
           "addressLine1" =>"الشارع الرئيسي", //required
            "addressLine2"=> "",
            "cityId"=>5, //required
            "country"=> "Jordan", //required
            "regionId" => 1, //required
            "villageId"=> 180 //required
       ];
       foreach ($models as $key => $model){
           $pkg[]=[
               "cost"=>2,
               "cod"=>$model['total_price'],
               "isInsurance" => false,
                "isBreakable"=> false,
                "isflammable"=> false,
                "isDangerousOrChemical"=> false,
                "isAnimalOrPit"=> false,
                "isNeedPacking"=> false,
               "notes" => $model['note'],
               "invoiceNumber"=>$model['order_id'],
               "weight"=> 20,
                "length"=> 40,
                "width"=> 40,
                "height"=> 40,
                "parcelTypeId"=> null,
               "senderFirstName"=>  "Majdi", //ask
                "senderLastName"=>  "Mafarja", //ask
               "senderMiddleName"=> "M",//ask
                "businessSenderName"=> "شركة لوجستكس",//ask
                "businessReceiverName"=> "",//ask
               "receiverAuthorizedGovRegistrationNumber"=> "",//ask
                "senderAuthorizedGovRegistrationNumber"=> "",//ask
               "senderEmail"=> "log@loges.com", //required - customer email ask
                "receiverFirstName"=> $model['user']['name'], //required
                "receiverLastName"=> "",
                "receiverMiddleName"=> "",
                "senderPhone"=> Yii::$app->params["phone"], //required
                "senderPhone2"=> Yii::$app->params["phone"],
                "receiverPhone"=> $model['user']['phone'] , //required
                "receiverPhone2"=>$model['user']['other_phone'] ,
                "receiverEmail"=> "",
                "serviceType"=> "STANDARD", //required
                "shipmentType"=> "COD", //required
                "quantity"=> 1

           ];










       }
       $array_pushed=[
           "pkg"=>$pkg,
           "destinationAddress"=>$destinationAddress,
           "pkgUnitType"=>$pkgUnitType,
           "originAddress"=>$originAddress,
           ];



       $request_headers = array(
           "Authorization-Token:" . "7be004ba6ae88fb4097ef885fdf5fe148886fd68b424b7192a0e060a58e10",
           "company-d:" . "143"
       );


       $ch = curl_init('http://www.example.com');
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $array_pushed);

       $response = curl_exec($ch);
       curl_close($ch);

       var_dump($response);
    }


    public  function push_order($model){
        $pkg=[];
        $destinationAddress=[
            "addressLine1" => "عين منجد", //required
            "cityId"=> 1, //required
            "villageId"=> 38, //required
            "regionId"=> 1, //required
            "country"=> "Jordan" //required
        ];
        $pkgUnitType="METRIC";
        $originAddress=[
            "addressLine1" =>"الشارع الرئيسي", //required
            "addressLine2"=> "",
            "cityId"=>5, //required
            "country"=> "Jordan", //required
            "regionId" => 1, //required
            "villageId"=> 180 //required
        ];
        $pkg[]=[
            "cost"=>2,
            "cod"=>$model['total_price'],
            "isInsurance" => false,
            "isBreakable"=> false,
            "isflammable"=> false,
            "isDangerousOrChemical"=> false,
            "isAnimalOrPit"=> false,
            "isNeedPacking"=> false,
            "notes" => $model['note'],
            "invoiceNumber"=>$model['order_id'],
            "weight"=> 20,
            "length"=> 40,
            "width"=> 40,
            "height"=> 40,
            "parcelTypeId"=> null,
            "senderFirstName"=>  "Majdi", //ask
            "senderLastName"=>  "Mafarja", //ask
            "senderMiddleName"=> "M",//ask
            "businessSenderName"=> "شركة لوجستكس",//ask
            "businessReceiverName"=> "",//ask
            "receiverAuthorizedGovRegistrationNumber"=> "",//ask
            "senderAuthorizedGovRegistrationNumber"=> "",//ask
            "senderEmail"=> "log@loges.com", //required - customer email ask
            "receiverFirstName"=> $model['user']['name'], //required
            "receiverLastName"=> "",
            "receiverMiddleName"=> "",
            "senderPhone"=> Yii::$app->params["phone"], //required
            "senderPhone2"=> Yii::$app->params["phone"],
            "receiverPhone"=> $model['user']['phone'] , //required
            "receiverPhone2"=>$model['user']['other_phone'] ,
            "receiverEmail"=> "",
            "serviceType"=> "STANDARD", //required
            "shipmentType"=> "COD", //required
            "quantity"=> 1

        ];
        $array_pushed=[
            "pkg"=>$pkg,
            "destinationAddress"=>$destinationAddress,
            "pkgUnitType"=>$pkgUnitType,
            "originAddress"=>$originAddress,
        ];



        $request_headers = array(
            "Authorization-Token:" . "7be004ba6ae88fb4097ef885fdf5fe148886fd68b424b7192a0e060a58e10",
            "company-d:" . "143"
        );


        $ch = curl_init('http://www.example.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array_pushed);

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

    public  function change_status($order_id){
        $array_pushed=[];


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
