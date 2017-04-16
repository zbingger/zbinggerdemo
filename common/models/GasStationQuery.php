<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[GasStation]].
 *
 * @see GasStation
 */
class GasStationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GasStation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GasStation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
