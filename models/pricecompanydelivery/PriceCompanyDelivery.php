<?php

namespace app\models\pricecompanydelivery;

use app\models\companydelivery\CompanyDelivery;
use app\models\regions\Regions;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%price_company_delivery}}".
 *
 * @property int $id
 * @property int|null $region_id
 * @property int|null $company_delivery_id
 * @property float $price
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PriceCompanyDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%price_company_delivery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'company_delivery_id'], 'integer'],
            [['price'], 'required'],
            [['price'], 'number'],
    
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region_id' => Yii::t('app', 'Region'),
            'company_delivery_id' => Yii::t('app', 'Company_Delivery'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PrQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrQuery(get_called_class());
    }

           /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;


            } else {
                $this->updated_at =$today;
            }

            return true;
        } else {
            return false;
        }
    }


    public function getCompany(){
        return $this->hasOne(CompanyDelivery::class,['id'=>'company_delivery_id']);
    }

    public function getRegion(){
        return $this->hasOne(Regions::class,['id'=>'region_id']);
    }
}
