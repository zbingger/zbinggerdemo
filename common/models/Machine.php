<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property integer $id
 * @property string $number
 * @property string $imei
 * @property integer $gas_station_id
 * @property integer $oilgunid
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
            [['number', 'imei', 'gas_station_id', 'oilgunid'], 'required'],
            [['gas_station_id', 'oilgunid'], 'integer'],
            [['number'], 'string', 'max' => 100],
            [['imei'], 'string', 'max' => 30],
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
            'gas_station_id' => '所属油站',
            'oilgunid' => '绑定油枪',
        ];
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
