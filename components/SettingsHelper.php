<?php

namespace  app\components;

use app\models\pricecompanydelivery\PriceCompanyDelivery;
use Yii;
use yii\base\BaseObject;
use app\models\subproductcount\SubProductCount;
use app\models\products\Products;
use app\models\status\Status;

class SettingsHelper extends BaseObject
{
        public $key_params=[
           'adminEmail',
           'senderEmail',
           'senderName',
           'bsDependencyEnabled',
           'phone',
           'facebook_id',
           'sanpchat_id',
           'sanpchat_email',
           'tiktok_id',
           'company_delivery',
           'massage_whatsapp',
           'name_of_store',
            'color_site',
            'font_color',
            'background_duration',
            'background_first_color',
            'background_second_color',
        ];

        public $default_value=[
            'adminEmail'=>'admin@admin.com',
            'senderEmail'=>'admin@admin.com',
            'senderName'=>'admin@admin.com',
            'bsDependencyEnabled'=>'true',
            'phone'=>'079926344',
            'facebook_id'=>'',
            'sanpchat_id'=>'',
            'sanpchat_email'=>'',
            'tiktok_id'=>'',
            'company_delivery'=>'1',
            'massage_whatsapp'=>'',
            'name_of_store'=>"anatfran",
            'color_site'=>"#",
            'font_color'=>"#",
            'background_duration'=>"to right",
            'background_first_color'=>"#",
            'background_second_color'=>"#",
        ];


        public function checked_isset(){
            $all_params=Yii::$app->params;
            foreach ($this->key_params as $key){
                if(!isset(Yii::$app->params[$key])){
                    $all_params[$key]=$this->default_value[$key];
                }
            }

            $parh="../config/params.php";
            $string="<?php \n return [ \n";
            foreach ($all_params as $key=> $param){
                $string.="'$key' => '$param', \n";
            }
            $string.="];\n ?>";
            // echo $string;
            // exit;
            file_put_contents($parh, $string);
        }



}