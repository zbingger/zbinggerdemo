<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Oil]].
 *
 * @see Oil
 */
class OilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Oil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Oil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
