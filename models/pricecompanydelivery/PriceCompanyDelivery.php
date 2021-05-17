<?php

namespace app\models\pricecompanydelivery;

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
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'company_delivery_id' => Yii::t('app', 'Company Delivery ID'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
