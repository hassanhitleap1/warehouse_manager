<?php

namespace app\models\OptionsSellProduct;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "options_sell_product".
 *
 * @property int $id
 * @property int $number
 * @property string $text
 * @property int $product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class OptionsSellProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options_sell_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'text', 'product_id','price'], 'required'],
            [['price'], 'double'],
            [['number', 'product_id'], 'integer'],
            [['text'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'text' => Yii::t('app', 'Text'),
            'product_id' => Yii::t('app', 'Product'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }


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
     * @return OptionsSellProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionsSellProductQuery(get_called_class());
    }
}
