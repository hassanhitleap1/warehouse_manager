<?php

namespace app\models\companydelivery;

/**
 * This is the ActiveQuery class for [[CompanyDelivery]].
 *
 * @see CompanyDelivery
 */
class CompanyDeliveryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CompanyDelivery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CompanyDelivery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
