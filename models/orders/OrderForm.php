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
    public $address;
    public $country_id;
    public $region_id;
  
  
  
  
}
