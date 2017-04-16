<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property integer $id
 * @property string $number
 * @property string $imei
 * @property integer $store_id
 * @property integer $oilgunids
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'imei', 'store_id', 'oilgunids'], 'required'],
            [['store_id',], 'integer'],
            [['number',], 'string', 'max' => 30],
            [['imei'], 'string', 'max' => 30],
            [['oilgunids',], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'number' => '机具编号',
            'imei' => 'IMEI',
            'store_id' => '所属门店',
            'oilgunids' => '绑定油枪',
        ];
    }

    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }


    /**
     * @inheritdoc
     * @return MachineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MachineQuery(get_called_class());
    }
}
