<?php
/**
 * Created by PhpStorm.
 * User: zbing
 * 商家个人资料设置
 * Date: 17-4-8
 * Time: 上午9:34
 */

namespace common\models;

use yii\base\Model;

class InfoForm extends Model
{
    public $id;
    public $username;
    public $oldusername;
    public $email;
    public $oldemail;
    public $password;
    public $oldpassword;
    public $name;
    public $contactor;
    public $prov;
    public $city;
    public $dist;
    public $address;
    public $category_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','oldusername', 'oldemail'], 'required'],
            ['username', 'trim'],
            ['username', 'required', 'message' => '账户名称不能为空'],
            ['username', 'match', 'pattern' => '/^1[3,4,5,7,8][0-9]{9}$/', 'message' => '{attribute}必须为11位手机号'],
            //['username', 'exist', 'targetClass' => '\common\models\User','filter'=>['username']],
            ['username', 'validateUsername',],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此{attribute}已经被使用'],
            ['email', 'validateEmail',],

            //['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['contactor', 'trim'],
            ['contactor', 'required'],

            [['prov', 'city', 'dist'], 'required'],

            ['address', 'trim'],
            ['address', 'required'],

            ['category_id', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [

            'id' => '主键',
            'username' => '账户名称',
            'oldusername' => '',
            'name' => '商户名称',
            'email' => 'Email',
            'oldemail' => '',
            'password' => '登录密码',
            'category_id' => '商户类型 ',
            'contactor' => '联系人姓名',
            'prov' => '省',
            'city' => '市',
            'dist' => '区',
            'address' => '联系地址',
        ];
    }

    public function validateUsername($attribute, $params)
    {
        $chekusername = User::find()->where("username != '" . $this->oldusername . "'")->andWhere("username ='" . $this->username . "'")->one();
        // $this->addError($attribute,  User::find()->where("username != '" . $this->oldusername . "'")->andWhere("username ='" . $this->username . "'")->createCommand()->getRawSql());
        if ($chekusername) {
            $this->addError($attribute, '此' . $this->username . '账户名称已经存在！');
        }

    }

    public function validateEmail($attribute, $params)
    {
        $chekemail = User::find()->where("email != '" . $this->oldusername . "'")->andWhere("email ='" . $this->username . "'")->one();
        if ($chekemail) {
            $this->addError($attribute, '此' . $this->email . 'Email已经存在！');
        }
    }

    public function update($id)
    {

        if (!$this->validate()) {
            return null;
        }
        //var_dump($id);exit;
        $merchant = Merchant::findOne($id);
        $user = User::findOne($merchant->uid);
        $user->username = $this->username;
        $user->email = $this->email;
        if($this->password !='' && $this->password != $user->password_hash){
            $user->setPassword($this->password);
        }

        $merchant->setScenario('single-save');//场景 个人资料修改
        //var_dump($merchant);exit;
        $merchant->prov = $this->prov;
        $merchant->city = $this->city;
        $merchant->dist = $this->dist;
        $merchant->adress = $this->address;
        $merchant->contactor = $this->contactor;
        $merchant->name = $this->name;
        $merchant->category_id = $this->category_id;

        $this->id = $id;


        return $user->save() && $merchant->save() ? $this : null;

    }
}