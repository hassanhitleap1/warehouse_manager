<?php

namespace app\models\products;

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
            [['name', 'thumbnail', 'purchasing_price', 'selling_price', 'category_id', 'warehouse_id', 'created_at', 'updated_at'], 'required'],
            [['purchasing_price', 'selling_price'], 'number'],
            [['quantity', 'category_id', 'status', 'supplier_id', 'unit_id', 'warehouse_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'purchasing_price' => Yii::t('app', 'Purchasing Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'category_id' => Yii::t('app', 'Category ID'),
            'status' => Yii::t('app', 'Status'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'warehouse_id' => Yii::t('app', 'Warehouse ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
