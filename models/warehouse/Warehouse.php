<?php

namespace app\models\warehouse;

use Yii;

/**
 * This is the model class for table "{{%warehouse}}".
 *
 * @property int $id
 * @property string $name
 * @property string $localtion
 * @property string $created_at
 * @property string $updated_at
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%warehouse}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'localtion', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'localtion'], 'string', 'max' => 32],
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
            'localtion' => Yii::t('app', 'Localtion'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return WarehouseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WarehouseQuery(get_called_class());
    }
}
