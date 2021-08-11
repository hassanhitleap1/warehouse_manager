<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;


class ApiOrderHelper extends BaseObject
{

    private $senderFirstName="mohammed";
    private $senderLastName="kiwan";
    private $senderMiddleName="kahled";
    private $request_headers=[
                        "Authorization-Token:" . "7be004ba6ae88fb4097ef885fdf5fe148886fd68b424b7192a0e060a58e10",
                        "company-id:" . "143"
                    ];

    /*
     * @param object ActiveModel
     */
    public  function push_order($model){


        print_r($model);
        exit;
        

        $pkg=[];
        $destinationAddress=[
            "addressLine1" => $model['address'], //required
            "cityId"=> 1, //required
            "villageId"=> 38, //required
            "regionId"=> 1, //required
            "country"=> "Jordan" //required
        ];
        $pkgUnitType="METRIC";
        $originAddress=[
            "addressLine1" =>$model['address'], //required
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
            "senderFirstName"=>  $this->senderFirstName, //ask
            "senderLastName"=>   $this->senderLastName, //ask
            "senderMiddleName"=>     $this->senderMiddleName,//ask
            "businessSenderName"=>  Yii::$app->params["name_of_store"],//ask
            "businessReceiverName"=> "wheel",//ask
            "receiverAuthorizedGovRegistrationNumber"=> "",//ask
            "senderAuthorizedGovRegistrationNumber"=> "",//ask
            "senderEmail"=> Yii::$app->params["adminEmail"]   , //required - customer email ask
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



    


        $ch = curl_init('http://www.example.com');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->request_headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array_pushed);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
        var_dump($response);

    }










    public function get_villages()
    {
        
        $page=1;
        $search="";
        $cityId="";
        $regionId="";
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }
        if(isset($_GET["search"])){
            $search=$_GET["search"];
        }

        if(isset($_GET["cityId"])){
            $cityId=$_GET["cityId"];
        }

        if(isset($_GET["regionId"])){
            $regionId=$_GET["regionId"];
        }

        $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/villages?search=$search&cityId=$cityId&regionId=$regionId&page=$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->request_headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);

    }




    public function get_cities()
    {

              
        $page=1;
        $search="";
        $cityId="";
      
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }
        if(isset($_GET["search"])){
            $search=$_GET["search"];
        }

        if(isset($_GET["cityId"])){
            $cityId=$_GET["cityId"];
        }

        $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/cities?search=$search&cityId=$cityId&page=$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->request_headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);

    }



    public function get_regions()
    {

        $page=1;
        $search="";
        $cityId="";
      
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }
        if(isset($_GET["search"])){
            $search=$_GET["search"];
        }
        
        $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/regions?search=$search&page=$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->request_headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);

    }

}

