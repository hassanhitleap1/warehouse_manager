<?php

namespace app\models\subproductcount;

use Yii;

/**
 * This is the model class for table "{{%sub_product_count}}".
 *
 * @property int $id
 * @property string $type
 * @property int $count
 * @property int $product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class SubProductCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sub_product_count}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'count', 'product_id'], 'required'],
            [['count', 'product_id'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'count' => Yii::t('app', 'Count'),
            'product_id' => Yii::t('app', 'Product'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubProductCountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubProductCountQuery(get_called_class());
    }
}
