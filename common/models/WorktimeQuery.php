<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Worktime]].
 *
 * @see Worktime
 */
class WorktimeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Worktime[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Worktime|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
