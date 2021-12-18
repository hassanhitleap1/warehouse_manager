<?php

namespace app\models\upsell;

use app\models\products\Products;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%upsell}}".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $upsell_product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property array $upsell_products_id;
 */
class Upsell extends \yii\db\ActiveRecord
{
    public $upsell_products_id;
    public $selected_product;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%upsell}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id','upsell_product_id','selected_product'], 'integer'],
            ['upsell_products_id','required']

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
            'upsell_product_id' => Yii::t('app', 'Upsell_Product'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getProduct(){
        return $this->hasOne(Products::class,['id'=>'product_id']);
    }

    public function getUpsellproduct(){
        return $this->hasOne(Products::class,['id'=>'upsell_product_id']);
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
     * @return UpsellQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UpsellQuery(get_called_class());
    }
}
