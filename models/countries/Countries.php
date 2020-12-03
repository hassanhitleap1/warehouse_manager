<?php

namespace app\models\countries;

use Yii;
use Carbon\Carbon;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property int $id
 * @property string|null $country_code
 * @property string $name_en
 * @property string $name_ar
 * @property string|null $nationality_en
 * @property string|null $nationality_ar
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ar'], 'required'],
            [['country_code'], 'string', 'max' => 5],
            [['name_en', 'name_ar', 'nationality_en', 'nationality_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_code' => Yii::t('app', 'Country_Code'),
            'name_en' => Yii::t('app', 'Name_En'),
            'name_ar' => Yii::t('app', 'Name_Ar'),
            'nationality_en' => Yii::t('app', 'Nationality_En'),
            'nationality_ar' => Yii::t('app', 'Nationality_Ar'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountriesQuery(get_called_class());
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
