<?php

namespace app\models\OptionsSellProduct;

use Yii;

/**
 * This is the model class for table "options_sell_product".
 *
 * @property int $id
 * @property string $type
 * @property int $number
 * @property string $text
 * @property int $product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class OptionsSellProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options_sell_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'number', 'text', 'product_id'], 'required'],
            [['number', 'product_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 2],
            [['text'], 'string', 'max' => 500],
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
            'number' => Yii::t('app', 'Number'),
            'text' => Yii::t('app', 'Text'),
            'product_id' => Yii::t('app', 'Product ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OptionsSellProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionsSellProductQuery(get_called_class());
    }
}
