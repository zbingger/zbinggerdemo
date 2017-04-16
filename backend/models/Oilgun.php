<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "oilgun".
 *
 * @property integer $id
 * @property string $number
 * @property integer $oil_id
 * @property integer $store_id
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
            [['number', 'oil_id', 'store_id'], 'required'],
            [['oil_id', 'store_id'], 'integer'],
            [['flag'], 'string'],
            [['number'], 'string', 'max' => 10],
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
            'oil_id' => '所属油品',
            'store_id' => '所属门店',
            'flag' => '开启状态',
        ];
    }

    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    public function getOil()
    {
        return $this->hasOne(Oil::className(), ['id' => 'oil_id']);
    }

    /**
     * @inheritdoc
     * @return OilgunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OilgunQuery(get_called_class());
    }
}
