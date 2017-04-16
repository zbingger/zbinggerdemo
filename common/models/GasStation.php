<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gas_station".
 *
 * @property integer $id
 * @property string $number
 * @property integer $merchant_id
 * @property string $name
 * @property string $telphone
 * @property string $area
 * @property string $address
 * @property string $point
 * @property integer $created_at
 */
class GasStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gas_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'name', 'telphone', 'area', 'address', 'point'], 'required'],
            [['created_at'], 'integer'],
            [['number'], 'string', 'max' => 15],
            [['name', 'telphone', 'area', 'address', 'point'], 'string', 'max' => 250],
            [['number'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'number' => '油站编号',
            'merchant_id' => '商户id',
            'name' => '油站名称',
            'telphone' => '油站电话',
            'area' => '所在区域',
            'address' => '具体地址',
            'point' => '坐标',
            'created_at' => '添加时间',
        ];
    }

    /**
     * @inheritdoc
     * @return GasStationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GasStationQuery(get_called_class());
    }
}
