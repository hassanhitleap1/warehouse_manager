<?php

namespace app\models\wishlists;

use Yii;

/**
 * This is the model class for table "{{%wishlists}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 */
class Wishlists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%wishlists}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return WishlistsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WishlistsQuery(get_called_class());
    }
}
