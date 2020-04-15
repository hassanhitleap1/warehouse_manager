<?php

namespace app\models\custumexport;

use Yii;

/**
 * This is the model class for table "custum_export".
 *
 * @property int $id
 * @property int $name
 * @property string $columns
 * @property string $created_at
 * @property string $updated_at
 */
class CustumExport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'custum_export';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'columns', 'created_at', 'updated_at'], 'required'],
            [['name'], 'integer'],
            [['columns'], 'string'],
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
            'name' => Yii::t('app', 'Name'),
            'columns' => Yii::t('app', 'Columns'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CustumExportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustumExportQuery(get_called_class());
    }
}
