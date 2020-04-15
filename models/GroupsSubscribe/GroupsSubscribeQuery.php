<?php

namespace app\models\groupssubscribe;

/**
 * This is the ActiveQuery class for [[GroupsSubscribe]].
 *
 * @see GroupsSubscribe
 */
class GroupsSubscribeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GroupsSubscribe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GroupsSubscribe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
