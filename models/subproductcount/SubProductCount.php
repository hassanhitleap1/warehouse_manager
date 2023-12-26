<?php

namespace app\models\subproductcount;

use app\models\products\Products;
use Yii;

/**
 * This is the model class for table "{{%sub_product_count}}".
 *
 * @property int $id
 * @property string $type
 * @property string $variant_id
 * @property int $count
 * @property int $product_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class SubProductCount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sub_product_count}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'custum_required_type', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['count'], 'custum_required_count', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['count', 'product_id'], 'integer'],
            [['type', 'variant_id'], 'string', 'max' => 255],
        ];
    }

    public function custum_required_type($attribute, $params)
    {
        if ($this->type == '' && ($this->count != '')) {
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    public function custum_required_count($attribute, $params)
    {
        if ($this->type == '' && ($this->count != '')) {
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'count' => Yii::t('app', 'Count'),
            'product_id' => Yii::t('app', 'Product'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SubProductCountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubProductCountQuery(get_called_class());
    }


    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
