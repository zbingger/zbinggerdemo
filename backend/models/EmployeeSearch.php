<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `backend\models\Employee`.
 */
class EmployeeSearch extends Employee
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'uid', 'merchant_id'], 'integer'],
            [['workno', 'mobile', 'realname', 'password', 'role', 'mark'], 'safe'],
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
        $query = Employee::find();

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
            'parent_id' => $this->parent_id,
            'uid' => $this->uid,
            'merchant_id' => $this->merchant_id,
        ]);

        $query->andFilterWhere(['like', 'workno', $this->workno])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'realname', $this->realname])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'mark', $this->mark]);

        return $dataProvider;
    }
}
