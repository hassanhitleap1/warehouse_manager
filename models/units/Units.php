<?php

namespace app\models\units;

use Yii;
use Carbon\Carbon;

/**
 * This is the model class for table "{{%units}}".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $created_at
 * @property string $updated_at
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%units}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ar'], 'required'],
            [['name_en', 'name_ar'], 'string', 'max' => 32],
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
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UnitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitsQuery(get_called_class());
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
