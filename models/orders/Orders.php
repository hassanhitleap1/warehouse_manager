<?php

namespace app\models\orders;

use app\models\area\Area;
use app\models\regions\Regions;
use Carbon\Carbon;
use app\models\ordersitem\OrdersItem;
use app\models\status\Status;
use app\models\users\Users;
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
    public $phone;
    public $name;
    public $other_phone;
    public $address;
    public $start;
    public $end;
    public $sub_product_id;
    public $profit_margin;
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
            [[ 'status_id','phone','other_phone','address','delivery_price','discount','total_price','amount_required'], 'required'],
            [['user_id', 'country_id', 'region_id', 'area_id', 'status_id','delivery_price','discount','total_price','amount_required','profit_margin'], 'integer'],
            [['delivery_date', 'delivery_time'], 'safe'],
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
            'order_id' => Yii::t('app', 'Order_Id'),
            'user_id' => Yii::t('app', 'Name'),
            'delivery_date' => Yii::t('app', 'Delivery_Date'),
            'delivery_time' => Yii::t('app', 'Delivery_Time'),
            'country_id' => Yii::t('app', 'Country'),
            'region_id' => Yii::t('app', 'Region'),
            'area_id' => Yii::t('app', 'Area'),
            'address' => Yii::t('app', 'Address'),
            'status_id' => Yii::t('app', 'Status'),
            'phone' => Yii::t('app', 'Phone'),
            'other_phone' => Yii::t('app', 'Other_Phone'),
            'address'=> Yii::t('app', 'Address'),
            'name' => Yii::t('app', 'Name'),
            'delivery_price' => Yii::t('app', 'Delivery_Price'),
            'discount' => Yii::t('app', 'Discount'),
            'total_price' => Yii::t('app', 'Total_Price'),
            'amount_required' => Yii::t('app', 'Amount_Required'),
            'sub_product_id'=> Yii::t('app', 'Sub_Product_Id'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
            'profit_margin'=> Yii::t('app', 'Profit_Margin'),
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


    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrdersItem::className(), ['order_id' => 'id']);
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




    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Regions::className(), ['id' => 'country_id']);
    }


    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    

}
