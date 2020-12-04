<?php

namespace app\models\subproductcount;

/**
 * This is the ActiveQuery class for [[SubProductCount]].
 *
 * @see SubProductCount
 */
class SubProductCountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SubProductCount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SubProductCount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
