<?php

namespace app\models\ordersitem;

/**
 * This is the ActiveQuery class for [[OrdersItem]].
 *
 * @see OrdersItem
 */
class OrdersItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrdersItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrdersItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
