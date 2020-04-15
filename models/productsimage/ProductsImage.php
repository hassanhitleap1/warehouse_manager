<?php

namespace app\models\productsimage;

use Carbon\Carbon;
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
            [['product_id', 'path'], 'required'],
            [['product_id'], 'integer'],
            [['path','thumbnail'], 'string', 'max' => 255],
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
            'thumbnail'=>Yii::t('app','thumbnail'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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

    /**
     * {@inheritdoc}
     * @return ProductsImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsImageQuery(get_called_class());
    }
}
