<?php

namespace app\models\pricecompanydelivery;

/**
 * This is the ActiveQuery class for [[PriceCompanyDelivery]].
 *
 * @see PriceCompanyDelivery
 */
class PriceCompanyDeliveryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PriceCompanyDelivery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PriceCompanyDelivery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
