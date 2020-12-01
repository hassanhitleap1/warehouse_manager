<?php

namespace app\models\area;

use Yii;

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
            [['created_at', 'updated_at'], 'safe'],
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
            'name_ar' => Yii::t('app', 'Name Ar'),
            'name_en' => Yii::t('app', 'Name En'),
            'region_id' => Yii::t('app', 'Region ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
