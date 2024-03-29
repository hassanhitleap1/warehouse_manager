<?php

namespace app\models\products;

use app\models\categorises\Categorises;
use app\models\OptionsSellProduct\OptionsSellProduct;
use app\models\productsimage\ProductsImage;
use app\models\subproductcount\SubProductCount;
use app\models\suppliers\Suppliers;
use app\models\upsell\Upsell;
use app\models\warehouse\Warehouse;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name
 * @property string $thumbnail
 * @property float $purchasing_price
 * @property float $selling_price
 * @property int $quantity
 * @property int $category_id
 * @property int $status
 * @property int|null $supplier_id
 * @property int|null $unit_id
 * @property int $warehouse_id
 * @property  int $featured
 * @property  int $top_selling
 * @property int|null  $label
 * @property string|null $countdown
 * @property string|null $discount
 * @property string $created_at
 * @property string $updated_at
 */
class Products extends \yii\db\ActiveRecord
{
    public $images_product;


    const To_Be_Equipped = 1;
    const To_Be_Ready = 2;
    const Ready = 3;
    const Connecting = 4;
    const To_Be_Deliverd = 5;
    const Canceled = 6;
    const Delayed = 7;
    const TYPE_DROP_DAWNLIST = 1;
    const TYPE_CHOOSE_BOX = 2;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    const SCENARIO_IMPORT = 'import';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'quantity', 'purchasing_price', 'selling_price', 'category_id', 'warehouse_id'], 'required', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['images_product',], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['purchasing_price', 'selling_price'], 'double', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['quantity', 'category_id', 'type_options', 'status', 'supplier_id', 'unit_id', 'warehouse_id', 'company_delivery_id', 'quantity_come', 'product_id'], 'integer', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['name'], 'string', 'max' => 255, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['video_url', 'thumbnail', 'thumb'], 'string', 'max' => 500, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['description'], 'string', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            [['top_selling', 'featured', 'label', 'countdown', 'days', 'hours', 'muints', 'second'], 'safe', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE, self::SCENARIO_IMPORT]],
            //[['days','hours','muints','second'],'max' => 60 ,'min'=>1 ,'on'=>[self::SCENARIO_UPDATE,self::SCENARIO_CREATE]],
            [['images_product'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,gif', 'maxFiles' => 20, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_CREATE]],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'thumbnail' => Yii::t('app', 'Thumbnail'),
            'purchasing_price' => Yii::t('app', 'Purchasing_Price'),
            'selling_price' => Yii::t('app', 'Selling_Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'quantity_come' => Yii::t('app', 'Quantity'),
            'category_id' => Yii::t('app', 'Category'),
            'status' => Yii::t('app', 'Status'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'unit_id' => Yii::t('app', 'Unit'),
            'warehouse_id' => Yii::t('app', 'Warehouse'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
            "images_product" => Yii::t('app', 'Images_Product'),
            "type_options" => Yii::t('app', 'Type_Options'),
            "video_url" => Yii::t('app', 'Video_Url'),
            "description" => Yii::t('app', 'Description'),
            'company_delivery_id' => Yii::t('app', 'Company_Delivery'),
            'featured' => Yii::t('app', 'Featured'),
            'top_selling' => Yii::t('app', 'Top_Selling'),
            'label' => Yii::t('app', 'Label'),
            'countdown' => Yii::t('app', 'Countdown'),
            'discount' => Yii::t('app', 'Discount'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubProductCount()
    {
        return $this->hasMany(SubProductCount::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeOptions()
    {
        return $this->hasMany(OptionsSellProduct::className(), ['product_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesProduct()
    {
        return $this->hasMany(ProductsImage::className(), ['product_id' => 'id']);
    }

    public function getUpsell()
    {
        return $this->hasMany(Upsell::class, ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today = Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;


            } else {
                $this->updated_at = $today;
            }

            return true;
        } else {
            return false;
        }
    }


    public function getCategory()
    {
        return $this->hasOne(Categorises::className(), ['id' => 'category_id']);
    }


    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouse_id']);
    }


    public function getSupplier()
    {
        return $this->hasOne(Suppliers::className(), ['id' => 'supplier_id']);
    }


    public function getUnit()
    {
        return $this->hasOne(Categorises::className(), ['id' => 'unit_id']);
    }



    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'imagesProduct';

        return $fields;
    }

}
