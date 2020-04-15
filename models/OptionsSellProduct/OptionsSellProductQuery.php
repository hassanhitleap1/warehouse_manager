<?php

namespace app\models\OptionsSellProduct;

/**
 * This is the ActiveQuery class for [[OptionsSellProduct]].
 *
 * @see OptionsSellProduct
 */
class OptionsSellProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OptionsSellProduct[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OptionsSellProduct|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
