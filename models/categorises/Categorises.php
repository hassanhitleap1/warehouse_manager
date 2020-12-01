<?php

namespace app\models\categorises;

use Yii;

/**
 * This is the model class for table "{{%categorises}}".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property string $created_at
 * @property string $updated_at
 */
class Categorises extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categorises}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ar', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
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
            'name_en' => Yii::t('app', 'Name En'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CategorisesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategorisesQuery(get_called_class());
    }
}
