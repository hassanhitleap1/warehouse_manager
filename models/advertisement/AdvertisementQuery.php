<?php

namespace app\models\advertisement;

/**
 * This is the ActiveQuery class for [[Advertisement]].
 *
 * @see Advertisement
 */
class AdvertisementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Advertisement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Advertisement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
