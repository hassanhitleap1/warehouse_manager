<?php

namespace app\models\ordersitem;

use Carbon\Carbon;
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
            [[ 'product_id', 'quantity'], 'required'],
            [['product_id', 'quantity'], 'integer'],
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
            'order_id' => Yii::t('app', 'Order_ID'),
            'product_id' => Yii::t('app', 'Product'),
            'sub_product_id'=> Yii::t('app', 'Product'),
            'quantity' => Yii::t('app', 'Quantity'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
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
