<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "oil".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $unit
 */
class Oil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['unit'], 'string'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'name' => '油品名称',
            'price' => '价格',
            'unit' => '单价元/升',
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
