<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Oilgun]].
 *
 * @see Oilgun
 */
class OilgunQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Oilgun[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Oilgun|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
