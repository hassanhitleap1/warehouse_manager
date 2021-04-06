<?php
namespace app\models\orders;

use Yii;
use yii\base\Model;

class  OrderForm extends Model{

  public $order_id;
   public $phone;
   public $name;
   public $other_phone;
   public $address;
   public $product_id;
   public $sub_product_id;
   public $amount_required;
   public $total_price;
   public $discount=0;
   public $delivery_price=0;
    public $country_id;
    public $region_id;
    public $typeoption;
    public $type;
  



       /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'phone','name'], 'required'],
            [[ 'region_id','typeoption','type'], 'integer'],
            [['name','address'],'string'],
            [['phone','other_phone'], 'isJordanPhone'],
           
        ];
    }

  

    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
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
            "typeoption"=>Yii::t('app', 'Choose_Offer'), 
            "type"=>Yii::t('app', 'Choose_Type'),
        ];
    }

  
}
