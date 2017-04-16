<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "worktime".
 *
 * @property integer $id
 * @property integer $begin
 * @property integer $end
 * @property string $name
 */
class Worktime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'worktime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin', 'end', 'name'], 'required'],
            [['begin', 'end'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'begin' => '上班时间',
            'end' => '下班时间 ',
            'name' => '班次名称',
        ];
    }

    /**
     * @inheritdoc
     * @return WorktimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorktimeQuery(get_called_class());
    }
}
