<?php

namespace app\models\orders;

use app\components\OrderHelper;
use app\models\area\Area;
use app\models\companydelivery\CompanyDelivery;
use app\models\countries\Countries;
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
    // public $address;
    public $start;
    public $end;
    public $sub_product_id;
    public $name_in_facebook;
    public $order;
    public $products_id=[] ;
    const DEPOTED=1;
    const UN_DEPOTED=0;

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
            [[ 'order_id','status_id','phone','name','address','delivery_price','discount','total_price','amount_required','region_id'], 'required'],
            [['user_id', 'country_id', 'region_id', 'area_id', 'status_id'], 'integer'],
            [['discount','total_price','delivery_price','amount_required','profit_margin'],'double'],
            [['delivery_date', 'delivery_time'], 'safe'],
            [['name','note'],'string'],
            [['address'], 'string', 'max' => 250],
            [['phone','other_phone'], 'isJordanPhone'],
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
            'note'=> Yii::t('app', 'Note'),
            'name_in_facebook'=>Yii::t('app', 'Name_In_Facebook'),
            'order'=>Yii::t('app', 'Orders'),
            'search_string'=>Yii::t('app', 'Search'),
            'company_delivery_id'=>Yii::t('app', 'Company_Delivery'),
            'products_id'=>Yii::t('app', 'Products'),
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

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->phone=trim($this->phone);
            $this->phone= OrderHelper::faTOen($this->phone);
            if(!is_null($this->other_phone)){
                $this->other_phone=trim($this->other_phone);
                $this->other_phone= OrderHelper::faTOen($this->other_phone);
            }
            return true;
        }
        return false;
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

    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
    }




    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    public function getCompany()
    {
        return $this->hasOne(CompanyDelivery::className(), ['id' => 'company_delivery_id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
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

    
    /**
     * get total
     */
    public static function getTotal($provider, $fieldName)
    {
        $total = 0;

        foreach ($provider as $item) {
            $total += $item[$fieldName];
        }

        return $total;
    }
}
