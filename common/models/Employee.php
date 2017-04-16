<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property integer $merchant_id
 * @property string $workno
 * @property string $mobile
 * @property string $realname
 * @property string $password
 * @property string $role
 * @property string $mark
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'workno', 'mobile', 'realname', 'password', 'mark'], 'required'],
            [['merchant_id'], 'integer'],
            [['workno', 'realname', 'password'], 'string', 'max' => 250],
            [['mobile'], 'string', 'max' => 13],
            [['role'], 'string', 'max' => 1],
            [['mark'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增（1，1）',
            'merchant_id' => '所属门铺id',
            'workno' => '工号',
            'mobile' => '手机号',
            'realname' => '姓名',
            'password' => '密码',
            'role' => '类型1普通店员 2站长默认1',
            'mark' => '备注',
        ];
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }
}
