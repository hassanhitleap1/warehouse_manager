<?php

namespace  app\components;

use Yii;
use yii\base\BaseObject;


class ApiCompanyDriverHelper extends BaseObject
{



   public  function get_villages($page=1){

       $request_headers = array(
           "Authorization-Token:" . "7993ea5662712ddabc4cbb088077aa4a25cd99561bc7f92910c0bfa69619de",
           "company-d:" . "143"
       );

       $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/villages?page=$page");
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

       $response = curl_exec($ch);
       curl_close($ch);
       return $response;


       }


    public  function get_regions($page=1){
        $request_headers = array(
            "Authorization-Token:" . "7be004ba6ae88fb4097ef885fdf5fe148886fd68b424b7192a0e060a58e10",
            "company-d:" . "143"
        );

        $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/regions?page=$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;


    }


    public  function get_cities($page=1){

        $request_headers = array(
            "Authorization-Token:" . "7be004ba6ae88fb4097ef885fdf5fe148886fd68b424b7192a0e060a58e10",
            "company-d:" . "143"
        );

        $ch = curl_init("https://apis.logestechs.com/saas/api/addresses/cities?page=$page");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;

    }


}
