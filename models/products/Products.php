<?php

namespace app\models\products;

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
 * @property string $created_at
 * @property string $updated_at
 */
class Products extends \yii\db\ActiveRecord
{

    public $file;
    public $images_product;
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
            [['name', 'purchasing_price', 'selling_price', 'category_id', 'warehouse_id'], 'required'],
            [['purchasing_price', 'selling_price'], 'number'],
            [['quantity', 'category_id', 'status', 'supplier_id', 'unit_id', 'warehouse_id'], 'integer'],
            [['name', 'thumbnail'], 'string', 'max' => 255],
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
            'category_id' => Yii::t('app', 'Category'),
            'status' => Yii::t('app', 'Status'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'unit_id' => Yii::t('app', 'Unit'),
            'warehouse_id' => Yii::t('app', 'Warehouse'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
            "images_product"=>Yii::t('app', 'Images_Product'),
        ];
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
