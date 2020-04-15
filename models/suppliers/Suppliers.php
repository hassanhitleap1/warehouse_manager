<?php

namespace app\models\suppliers;

use app\models\area\Area;
use app\models\countries\Countries;
use app\models\regions\Regions;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%suppliers}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string $phone
 * @property string|null $other_phone
 * @property string|null $site
 * @property string|null $location
 * @property string|null $email
 * @property int|null $country_id
 * @property int|null $region_id
 * @property int|null $area_id
 * @property string $created_at
 * @property string $updated_at
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%suppliers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['country_id', 'region_id', 'area_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['phone', 'other_phone', 'site'], 'string', 'max' => 32],
            [['location'], 'string', 'max' => 254],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
            'phone' => Yii::t('app', 'Phone'),
            'other_phone' => Yii::t('app', 'Other_Phone'),
            'site' => Yii::t('app', 'Site'),
            'location' => Yii::t('app', 'Location'),
            'email' => Yii::t('app', 'Email'),
            'country_id' => Yii::t('app', 'Country'),
            'region_id' => Yii::t('app', 'Region'),
            'area_id' => Yii::t('app', 'Area'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SuppliersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuppliersQuery(get_called_class());
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



    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }
    
    
}
