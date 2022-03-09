<?php

namespace app\models\wishlists;

/**
 * This is the ActiveQuery class for [[Wishlists]].
 *
 * @see Wishlists
 */
class WishlistsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Wishlists[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Wishlists|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
