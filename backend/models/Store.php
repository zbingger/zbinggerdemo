<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property string $number
 * @property string $name
 * @property string $telphone
 * @property string $area
 * @property string $address
 * @property string $point
 * @property integer $created_at
 *
 *
 * @preperty Merchant $merchant
 */
class Store extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'created_at'], 'integer'],
            [['number', 'name', 'telphone', 'area', 'address', 'point'], 'required'],
            [['number'], 'string', 'max' => 15],
            [['name', 'telphone', 'area', 'address', 'point'], 'string', 'max' => 250],
            [['number'], 'unique'],
            ['created_at', 'default', 'value' => time()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'merchant_id' => '商户id',
            'number' => '油站编号',
            'name' => '油站名称',
            'telphone' => '油站电话',
            'area' => '所在区域',
            'address' => '具体地址',
            'point' => '坐标',
            'created_at' => '添加时间',
        ];
    }

    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['uid' => 'merchant_id']);
    }

    /**
     * @inheritdoc
     * @return StoreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoreQuery(get_called_class());
    }
}
