<?php

namespace backend\models;

use yii;
use yii\base\Model;

use common\models\User;
use yii\web\UploadedFile;

/**
 * Class RegisterForm
 * @package backend\models
 */
class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $name;
    public $contactor;
    public $prov;
    public $city;
    public $dist;
    public $address;
    public $category_id;
    public $lisences;//营业执照'
    public $pic;//法人证件正照'
    public $pic1;//法人反面'
    public $openlicences;//开户许可证'
    public $wxpublicid;//微信公众号id
    public $wxsellerid;//微信商户号

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'password', 'confirmPassword', 'email', 'contactor', 'prov', 'city', 'dist', 'address', 'category_id',], 'required'],
            [['username', 'name', 'email', 'contactor', 'address',], 'string', 'max' => 100,],
            ['username', 'match', 'pattern' => '/^1[3,4,5,7,8][0-9]{9}$/', 'message' => '{attribute}必须为11位手机号'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此{attribute}已经被使用'],
            //['username', 'validateUsername',],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'operator' => '===',],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此{attribute}已经被使用'],
            [['wxpublicid', 'wxsellerid'], 'string'],
            [['password', 'confirmPassword'], 'string', 'min' => 6],
            [['prov', 'city', 'dist',], 'integer'],
            [['pic', 'pic1', 'openlicences', 'lisences'], 'image', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg'], 'maxSize' => 1024 * 1024 * 5, 'minWidth' => 100, 'maxWidth' => 1000, 'minHeight' => 100, 'maxHeight' => 1000,],
            //[['pic', 'pic1', 'openlicences', 'lisences'], 'file', 'extensions' => 'jpg,png', 'maxSize' => 1024 * 1024 * 5, 'message' => '文件大于5Mb,上传失败！请上传小于5M的文件！', 'skipOnEmpty' => false,],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '商户账号',
            'confirmPassword' => '重复密码',
            'name' => '商户名称',
            'email' => 'Email',
            'password' => '登录密码',
            'category_id' => '商户类型 ',
            'contactor' => '联系人姓名',
            'prov' => '省',
            'city' => '市',
            'dist' => '区',
            'address' => '联系地址',
            'lisences' => '营业执照',
            'pic' => '法人证件正面照片',
            'pic1' => '法人证件反面照片',
            'openlicences' => '开户许可证照片',
            'wxpublicid' => '微信公众号ID',
            'wxsellerid' => '微信商户号',
        ];
    }

    public function Register()
    {

        if (!$this->validate()) {

            return null;
        }
        //echo '<pre/>', var_dump(  $this);exit;

        $user_model = new User();
        $user_model->username = $this->username;
        $user_model->email = $this->email;
        $user_model->setPassword($this->confirmPassword);
        $user_model->generateAuthKey();
        $isTrue = $user_model->save(false);

        $merchant_model = new Merchant();

        $merchant_model->password = $this->confirmPassword;
        $merchant_model->uid = $user_model->id;
        $merchant_model->name = $this->name;
        $merchant_model->category_id = $this->category_id;
        $merchant_model->prov = $this->prov;
        $merchant_model->city = $this->city;
        $merchant_model->dist = $this->dist;
        $merchant_model->address = $this->address;
        $merchant_model->contactor = $this->contactor;
        $merchant_model->weixinpubid = $this->wxpublicid;
        $merchant_model->weixinsellerid = $this->wxsellerid;

        if ($this->pic) {
            $merchant_model->pic = self::uploadFile($this->pic);
        }
        if ($this->pic1) {
            $merchant_model->pic1 = self::uploadFile($this->pic1);
        }
        if ($this->openlicences) {
            $merchant_model->openlicences = self::uploadFile($this->openlicences);
        }
        if ($this->lisences) {
            $merchant_model->lisences = self::uploadFile($this->lisences);
        }
        //echo '<pre>',  var_dump($merchant_model->getValidators());exit;
        //if($merchant_model->validate()){
        //echo $merchant_model->getValidators()[1]->message;
        //}

        $isInserted = Yii::$app->db->createCommand()->insert('merchant', [
            'name' => $this->name,
            'password' => $this->password,
            'uid' => $user_model->id,
            'category_id' => $this->category_id,
            'prov' => $this->prov,
            'city' => $this->city,
            'dist' => $this->dist,
            'address' => $this->address,
            'contactor' => $this->contactor,
            'weixinpubid' => $this->wxpublicid,
            'weixinsellerid' => $this->wxsellerid,
            'pic' => $merchant_model->pic,
            'pic1' => $merchant_model->pic1,
            'openlicences' => $merchant_model->openlicences,
            'lisences' => $merchant_model->lisences,
        ])->execute();
        //Yii::$app->db->getLastInsertID();
        $isTrue = $isTrue && $isInserted > 0;

        return $isTrue ? true : null;

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

    public function uploadFile($file)
    {
        if ($file) {
            $date = date("Ymd", time());
            $tempsdir = Yii::$app->params['tempsDir'];//临时目录
            if (!isset($tempsdir)) {
                if (!mkdir($tempsdir, 0777, true)) {
                    return false;
                }
            }
            //$path=Yii::$app->params['tempsDir']
            //if(){}
            $upimgName = md5($file->baseName . time() . rand(10000, 99999)) . '.' . $file->extension;
            $file->saveAs($tempsdir . $upimgName);

            //$path = Yii::$app->params['imgUrl'] . '/image/u' . $model->id . '/' . $date . '/';
            /*
            if ($UpImages->extension != 'jpg' && $UpImages->extension != 'png') {
                \Yii::$app->session->setFlash('error', '[“' . $label . '”]格式必须为.jpg或者.png');
                return false;
            }
            */
            return $tempsdir . DIRECTORY_SEPARATOR . $upimgName;
            //return '/' . Yii::$app->params['imgUrl'] . '/image/u' . $model->id . '/' . $date . '/' . $upimgName;
        }
        return false;
    }
}