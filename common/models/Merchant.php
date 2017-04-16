<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
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
 */
class Merchant extends \yii\db\ActiveRecord
{
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
            [['id', 'name', 'contactor', 'prov', 'city', 'dist', 'adress', 'lisences', 'pic', 'pic1', 'openlicences'], 'required'],
            [['id', 'actived_at'], 'integer'],
            [['weixin_rate', 'alipay_rate'], 'number'],
            [['category_id', 'status_acount', 'status_wxpay', 'status_wxpub', 'status_alipay'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['actived_code'], 'string', 'max' => 6],
            [['contactor', 'city', 'dist'], 'string', 'max' => 50],
            [['prov'], 'string', 'max' => 10],
            [['adress', 'weixinpubid', 'weixinsellerid', 'lisences', 'openlicences'], 'string', 'max' => 250],
            [['pic', 'pic1'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '商户名称',
            'actived_at' => '开通时间',
            'actived_code' => '激活码',
            'weixin_rate' => '微信支付费率',
            'alipay_rate' => '支付宝支付费率',
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
}
