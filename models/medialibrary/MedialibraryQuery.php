<?php

namespace app\models\medialibrary;

/**
 * This is the ActiveQuery class for [[Medialibrary]].
 *
 * @see Medialibrary
 */
class MedialibraryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Medialibrary[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Medialibrary|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
