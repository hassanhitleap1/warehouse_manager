<?php

namespace app\models\orders;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property string $order_id
 * @property int|null $user_id
 * @property string|null $delivery_date
 * @property string|null $delivery_time
 * @property int|null $country_id
 * @property int|null $region_id
 * @property int|null $area_id
 * @property string|null $address
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'status_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'country_id', 'region_id', 'area_id', 'status_id'], 'integer'],
            [['delivery_date', 'delivery_time', 'created_at', 'updated_at'], 'safe'],
            [['order_id'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 250],
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
            'user_id' => Yii::t('app', 'User ID'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'delivery_time' => Yii::t('app', 'Delivery Time'),
            'country_id' => Yii::t('app', 'Country ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'address' => Yii::t('app', 'Address'),
            'status_id' => Yii::t('app', 'Status ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
