<?php

namespace app\models\ordersitem;

use Yii;

/**
 * This is the model class for table "{{%orders_item}}".
 *
 * @property int $id
 * @property string $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $created_at
 * @property string $updated_at
 */
class OrdersItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity', 'created_at', 'updated_at'], 'required'],
            [['product_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrdersItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersItemQuery(get_called_class());
    }
}
