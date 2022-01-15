<?php

namespace app\models\silder;

/**
 * This is the ActiveQuery class for [[Silder]].
 *
 * @see Silder
 */
class SQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Silder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Silder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
