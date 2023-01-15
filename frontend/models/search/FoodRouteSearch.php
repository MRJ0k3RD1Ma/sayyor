<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodRoute;

/**
 * FoodRouteSearch represents the model behind the search form of `common\models\FoodRoute`.
 */
class FoodRouteSearch extends FoodRoute
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'director_id', 'leader_id', 'executor_id', 'state_id', 'sample_id', 'registration_id', 'status_id'], 'integer'],
            [['deadline', 'ads', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = FoodRoute::find();

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
            'director_id' => $this->director_id,
            'leader_id' => $this->leader_id,
            'executor_id' => $this->executor_id,
            'deadline' => $this->deadline,
            'state_id' => $this->state_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'sample_id' => $this->sample_id,
            'registration_id' => $this->registration_id,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
}
