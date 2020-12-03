<?php

namespace app\models\area;

use app\models\regions\Regions;
use Yii;
use Carbon\Carbon;

/**
 * This is the model class for table "area".
 *
 * @property int $id
 * @property string $name_ar
 * @property string|null $name_en
 * @property int|null $region_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ar'], 'required'],
            [['region_id'], 'integer'],
            [['name_ar', 'name_en'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ar' => Yii::t('app', 'Name_Ar'),
            'name_en' => Yii::t('app', 'Name_En'),
            'region_id' => Yii::t('app', 'Region_ID'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AreaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AreaQuery(get_called_class());
    }


     
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
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
