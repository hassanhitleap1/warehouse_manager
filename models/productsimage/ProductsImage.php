<?php

namespace app\models\productsimage;

use Yii;

/**
 * This is the model class for table "{{%products_image}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 */
class ProductsImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'path', 'created_at', 'updated_at'], 'required'],
            [['product_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'path' => Yii::t('app', 'Path'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsImageQuery(get_called_class());
    }
}
