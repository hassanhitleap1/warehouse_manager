<?php

namespace app\models\companydelivery;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%company_delivery}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class CompanyDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_delivery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250],
            [['address'], 'string', 'max' => 300],
            [['phone'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CompanyDeliveryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyDeliveryQuery(get_called_class());
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
}
