<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use common\traits\UploadImgTrait;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property integer $actived_at
 * @property string $actived_code
 * @property double $weixin_rate
 * @property double $alipay_rate
 * @property string $category_id
 * @property string $contactor
 * @property string $prov
 * @property string $city
 * @property string $dist
 * @property string $adress
 * @property string $weixinpubid
 * @property string $weixinsellerid
 * @property string $lisences
 * @property string $pic
 * @property string $pic1
 * @property string $openlicences
 * @property string $status_acount
 * @property string $status_wxpay
 * @property string $status_wxpub
 * @property string $status_alipay
 *
 * @property User $u
 */
class Merchant extends \yii\db\ActiveRecord
{

    use UploadImgTrait;
    /**
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['add'] = ['name', 'password','contactor', 'prov', 'city', 'dist', 'adress',];
        $scenarios['register'] = [ 'name', 'password', 'contactor', 'prov', 'city', 'dist', 'adress', 'lisences', 'pic', 'pic1', 'openlicences']; //注册
        $scenarios['single-save'] = ['name', 'password', 'contactor', 'prov', 'city', 'dist', 'adress']; //个人资料修改
        $scenarios['update']= [ 'name','password', 'contactor', 'prov', 'city', 'dist', 'adress',];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'password','name', 'contactor', 'prov', 'city', 'dist', 'adress', 'lisences', 'pic', 'pic1', 'openlicences'], 'required',],
            [['uid', 'actived_at'], 'integer'],
            ['password','string','min'=>6,'on'=>['add','update']],
            [['weixin_rate', 'alipay_rate'], 'number'],
            [['category_id', 'status_acount', 'status_wxpay', 'status_wxpub', 'status_alipay'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['actived_code'], 'string', 'max' => 6],
            [['contactor','prov','city', 'dist'], 'string', 'max' => 50 ,'on'=>['add','register']],
            [['adress', 'weixinpubid', 'weixinsellerid',], 'string', 'max' => 250],
            [['pic', 'pic1', 'openlicences', 'lisences'], 'safe', 'on'=>['add','update']],
            //[['pic', 'pic1', 'openlicences', 'lisences'], 'file', 'extensions' => 'jpg,png', 'skipOnEmpty' => false,'on'=>['add',]],
            [['uid'], 'unique'],
            [['uid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'uid' => 'uid',
            'password'=>'登录密码',
            'name' => '商户名称',
            'actived_at' => '开通时间',
            'actived_code' => '激活码',
            'weixin_rate' => '微信费率',
            'alipay_rate' => '支付宝费率',
            'category_id' => '商户类型 ',
            'contactor' => '联系人姓名',
            'prov' => '省',
            'city' => '市',
            'dist' => '区',
            'adress' => '联系地址',
            'weixinpubid' => '微信公众号id',
            'weixinsellerid' => '微信商户号id',
            'lisences' => '营业执照',
            'pic' => '法人证件正照',
            'pic1' => '法人反面',
            'openlicences' => '开户许可证',
            'status_acount' => '账户状态',
            'status_wxpay' => '微信支付状态',
            'status_wxpub' => '微信公众号状态',
            'status_alipay' => '支付宝状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * @inheritdoc
     * @return MerchantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MerchantQuery(get_called_class());
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->isNewRecord) {
                $lisences = $this->uploadImg($this, $this->attributeLabels(), 'lisences');
                $openlicences = $this->uploadImg($this, $this->attributeLabels(), 'openlicences');
                $pic = $this->uploadImg($this, $this->attributeLabels(), 'pic');
                $pic1 = $this->uploadImg($this, $this->attributeLabels(), 'pic1');
                if ($lisences == false) {

                    return false;
                } else {
                    $this->lisences = $lisences;
                }
                if ($openlicences == false) {
                    return false;
                } else {
                    $this->openlicences = $openlicences;
                }
                if ($pic == false) {
                    return false;
                } else {
                    $this->pic = $pic;
                }
                if ($pic1 == false) {
                    return false;
                } else {
                    $this->pic1 = $pic;
                }
            } else {
                if (UploadedFile::getInstance($this, 'lisences')) {
                    if ($lisences = $this->uploadImg($this, $this->attributeLabels(), 'lisences') ) {
                        return false;
                    } else {
                        $this->lisences = $lisences;
                    }

                }
                if (UploadedFile::getInstance($this, 'openlicences')) {
                    if ($openlicences = $this->uploadImg($this, $this->attributeLabels(), 'openlicences') ) {
                        return false;
                    } else {
                        $this->lisences = $openlicences;
                    }

                }
                if (UploadedFile::getInstance($this, 'pic')) {
                    if ($pic = $this->uploadImg($this, $this->attributeLabels(), 'lisences') ) {
                        return false;
                    } else {
                        $this->lisences = $lisences;
                    }

                }
                if (UploadedFile::getInstance($this, 'pic1')) {
                    if ($pic1 = $this->uploadImg($this, $this->attributeLabels(), 'lisences')) {
                        return false;
                    } else {
                        $this->lisences = $pic1;
                    }

                }
            }

            return true;
        }
        return false;
        //return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
