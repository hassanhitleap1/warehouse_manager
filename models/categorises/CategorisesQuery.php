<?php

namespace app\models\categorises;

/**
 * This is the ActiveQuery class for [[Categorises]].
 *
 * @see Categorises
 */
class CategorisesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Categorises[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Categorises|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
