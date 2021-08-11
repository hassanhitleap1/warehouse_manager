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


/*
 * {
    "data": [
        {
            "name": "Aabel Al Qameh",
            "arabicName": "آبل القمح",
            "cityId": 27,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 4,
            "regionName": "48 Cities",
            "cityName": "Yafa",
            "createdDate": "2019-10-01T20:04:33.000+0000",
            "id": 533
        },
        {
            "name": "Aappa",
            "arabicName": "عابا",
            "cityId": 7,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Jenin",
            "createdDate": "2019-10-01T19:57:07.000+0000",
            "id": 310
        },
        {
            "name": "Aboud",
            "arabicName": "عابود",
            "cityId": 5,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Ramallah and Al-Bireh",
            "createdDate": "2019-10-01T19:54:52.000+0000",
            "id": 210
        },
        {
            "name": "Abu Dis",
            "arabicName": "أبو ديس",
            "cityId": 5,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Ramallah and Al-Bireh",
            "createdDate": "2019-10-01T19:51:36.000+0000",
            "id": 76
        },
        {
            "name": "Abu Qash",
            "arabicName": "أبو قش",
            "cityId": 5,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Ramallah and Al-Bireh",
            "createdDate": "2019-10-01T19:53:48.000+0000",
            "id": 160
        },
        {
            "name": "Abu Shkheidam",
            "arabicName": "أبو شخيدم",
            "cityId": 5,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Ramallah and Al-Bireh",
            "createdDate": "2019-10-01T19:53:47.000+0000",
            "id": 159
        },
        {
            "name": "Abu Shkheidam",
            "arabicName": "أبوشخيدم",
            "cityId": 5,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 1,
            "regionName": "West Bank",
            "cityName": "Ramallah and Al-Bireh",
            "createdDate": "2019-10-01T19:53:57.000+0000",
            "id": 167
        },
        {
            "name": "Abu Shoosha",
            "arabicName": "أبو شوشة",
            "cityId": 26,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 4,
            "regionName": "48 Cities",
            "cityName": "Beer Al Sabe'",
            "createdDate": "2019-10-01T20:02:55.000+0000",
            "id": 471
        },
        {
            "name": "Abu Talloul",
            "arabicName": "أبو تلول",
            "cityId": 29,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 4,
            "regionName": "48 Cities",
            "cityName": "Al Ramla",
            "createdDate": "2019-10-01T20:05:36.000+0000",
            "id": 568
        },
        {
            "name": "Abu Zraiq",
            "arabicName": "أبو زريق",
            "cityId": 26,
            "isSelected": true,
            "isAddedByUser": false,
            "numberOfPackages": 0,
            "regionId": 4,
            "regionName": "48 Cities",
            "cityName": "Beer Al Sabe'",
            "createdDate": "2019-10-01T20:02:43.000+0000",
            "id": 464
        }
    ],
    "totalRecordsNo": 0
}
 */