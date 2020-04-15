<?php

namespace app\models\historystatus;

/**
 * This is the ActiveQuery class for [[HistoryStatus]].
 *
 * @see HistoryStatus
 */
class HistoryStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoryStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoryStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
