
<?php


use yii\base\Model;

class Settings extends Model
{
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


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['adminEmail', 'senderEmail', 'senderName', 'bsDependencyEnabled','facebook_id','sanpchat_id','sanpchat_email','tiktok_id','company_delivery'], 'required'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adminEmail' => Yii::t('app', 'adminEmail'),
            'senderEmail' => Yii::t('app', 'senderEmail'),
            'senderName' => Yii::t('app', 'senderName'),
            'bsDependencyEnabled' => Yii::t('app', 'bsDependencyEnabled'),
            'facebook_id' => Yii::t('app', 'facebook_id'),
            'sanpchat_id' => Yii::t('app', 'sanpchat_id'),
            'sanpchat_email' => Yii::t('app', 'sanpchat_email'),
            'tiktok_id' => Yii::t('app', 'tiktok_id'),
            'company_delivery' => Yii::t('app', 'company_delivery'),
        ];
    }
}