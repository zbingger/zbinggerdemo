<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * StoreSearch represents the model behind the search form about `backend\models\Store`.
 */
class StoreSearch extends Store
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'merchant_id', 'created_at'], 'integer'],
            [['number', 'name', 'telphone', 'area', 'address', 'point'], 'safe'],
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
        $query = Store::find();
        $userrole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if (isset($userrole) && $userrole['站长']->name === '站长') {
            //$employee = Employee::findOne(Yii::$app->user->id);
            $dataProvider = new ActiveDataProvider([
                'query' => $query->where(['id' => Yii::$app->user->id]),
            ]);

        } else {
            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'merchant_id' => $this->merchant_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'point', $this->point]);

        return $dataProvider;
    }
}
