<?php

namespace app\models\regions;

use app\models\countries\Countries;
use Yii;
use Carbon\Carbon;

/**
 * This is the model class for table "{{%regions}}".
 *
 * @property int $id
 * @property string|null $name_en
 * @property string $name_ar
 * @property float|null $price_delivery
 * @property int $country_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ar'], 'required'],
            [['price_delivery'], 'number'],
            [['country_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name_en', 'name_ar',"key"], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_en' => Yii::t('app', 'Name_En'),
            'name_ar' => Yii::t('app', 'Name_Ar'),
            'price_delivery' => Yii::t('app', 'Price_Delivery'),
            'country_id' => Yii::t('app', 'Country'),
            "key" => Yii::t('app', 'Key'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionsQuery(get_called_class());
    }


         
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
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
