<?php
namespace app\models\settings;

use Yii;
use yii\base\Model;

class Settings extends Model
{
    public $params=[];
    public $adminEmail;
    public $senderEmail;
    public $senderName;
    public $bsDependencyEnabled;
    public $phone;
    public $facebook_id;
    public $sanpchat_id;
    public $sanpchat_email;
    public $tiktok_id;
    public $company_delivery;
    public $logo;
    public $massage_whatsapp;
    public $name_of_store;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['adminEmail', 'massage_whatsapp','name_of_store','senderEmail', 'senderName', 'bsDependencyEnabled', 'phone','facebook_id','sanpchat_id','sanpchat_email','tiktok_id','company_delivery'], 'required'],
            [['massage_whatsapp','name_of_store'],'string'],
            [['logo'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name_of_store'=> Yii::t('app', 'Name_Of_Store'),
            'massage_whatsapp'=> Yii::t('app', 'Massage_Whatsapp'),
            'adminEmail' => Yii::t('app', 'adminEmail'),
            'senderEmail' => Yii::t('app', 'senderEmail'),
            'senderName' => Yii::t('app', 'senderName'),
            'bsDependencyEnabled' => Yii::t('app', 'bsDependencyEnabled'),
            'facebook_id' => Yii::t('app', 'facebook_id'),
            'sanpchat_id' => Yii::t('app', 'sanpchat_id'),
            'sanpchat_email' => Yii::t('app', 'sanpchat_email'),
            'tiktok_id' => Yii::t('app', 'tiktok_id'),
            'phone'=> Yii::t('app', 'Phone'),
            'company_delivery' => Yii::t('app', 'Company_Delivery'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }
}