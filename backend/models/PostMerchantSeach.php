<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Merchant;

/**
 * PostMerchantSeach represents the model behind the search form about `backend\models\Merchant`.
 */
class PostMerchantSeach extends Merchant
{
    public $username; //<=====就是加在这里
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'actived_at'], 'integer'],
            [['username', 'name', 'actived_code', 'password', 'category_id', 'contactor', 'prov', 'city', 'dist', 'adress', 'weixinpubid', 'weixinsellerid', 'lisences', 'pic', 'pic1', 'openlicences', 'status_acount', 'status_wxpay', 'status_wxpub', 'status_alipay'], 'safe'],
            [['weixin_rate', 'alipay_rate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Merchant::find();
        $query->joinWith(['user']);//<=====加入这句
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        $dataProvider->setSort([
            'attributes' => [
                /* 其它字段不要动 */
                /*  下面这段是加入的 */
                /*=============*/
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC],
                    'label' => '商户账号'
                ],
                /*=============*/
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
            'actived_at' => $this->actived_at,
            'weixin_rate' => $this->weixin_rate,
            'alipay_rate' => $this->alipay_rate,
        ]);
        $query->andFilterWhere(['like', 'user.username', $this->username]) //<=====加入这句
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'actived_code', $this->actived_code])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'contactor', $this->contactor])
            ->andFilterWhere(['like', 'prov', $this->prov])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'dist', $this->dist])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'weixinpubid', $this->weixinpubid])
            ->andFilterWhere(['like', 'weixinsellerid', $this->weixinsellerid])
            ->andFilterWhere(['like', 'lisences', $this->lisences])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'pic1', $this->pic1])
            ->andFilterWhere(['like', 'openlicences', $this->openlicences])
            ->andFilterWhere(['like', 'status_acount', $this->status_acount])
            ->andFilterWhere(['like', 'status_wxpay', $this->status_wxpay])
            ->andFilterWhere(['like', 'status_wxpub', $this->status_wxpub])
            ->andFilterWhere(['like', 'status_alipay', $this->status_alipay]);

        return $dataProvider;
    }
}
