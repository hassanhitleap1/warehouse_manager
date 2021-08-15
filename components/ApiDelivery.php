<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;


class ApiDelivery extends BaseObject
{


    private $request_headers=[
                        "Authorization-Token:" . "7993ea5662712ddabc4cbb088077aa4a25cd99561bc7f92910c0bfa69619de",
                        "company-id:" . "143"
                    ];




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

