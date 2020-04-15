<?php

namespace app\models\upsell;

/**
 * This is the ActiveQuery class for [[Upsell]].
 *
 * @see Upsell
 */
class UpsellQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Upsell[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Upsell|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
