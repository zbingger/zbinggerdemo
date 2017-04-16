<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Machine;

/**
 * MachineSearch represents the model behind the search form about `backend\models\Machine`.
 */
class MachineSearch extends Machine
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_id'], 'integer'],
            [['number', 'imei','oilgunids'], 'safe'],
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
        $query = Machine::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'store_id' => $this->store_id,
            'oilgunids' => $this->oilgunids,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'imei', $this->imei]);

        return $dataProvider;
    }
}
