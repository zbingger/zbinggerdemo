<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "oilgun".
 *
 * @property integer $id
 * @property string $number
 * @property integer $oil_id
 * @property integer $merchant_id
 * @property string $flag
 */
class Oilgun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oilgun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'oil_id', 'merchant_id'], 'required'],
            [['id', 'oil_id', 'merchant_id'], 'integer'],
            [['number'], 'string', 'max' => 10],
            [['flag'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'number' => '枪号',
            'oil_id' => '所属油器',
            'merchant_id' => '所属门店',
            'flag' => '开启状态1启用默认2禁用',
        ];
    }

    /**
     * @inheritdoc
     * @return OilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OilQuery(get_called_class());
    }
}
