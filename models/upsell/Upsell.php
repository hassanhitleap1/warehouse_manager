<?php

namespace app\models\upsell;

use Yii;

/**
 * This is the model class for table "{{%upsell}}".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $list_product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Upsell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%upsell}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['list_product_id'], 'string'],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'list_product_id' => Yii::t('app', 'List Product ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UpsellQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UpsellQuery(get_called_class());
    }
}
