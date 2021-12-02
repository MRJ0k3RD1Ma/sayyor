<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Animals;

/**
 * AnimalsSearch represents the model behind the search form of `app\models\Animals`.
 */
class AnimalsSearch extends Animals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'gender', 'vet_site_id', 'type_id'], 'integer'],
            [['name', 'birthday', 'inn', 'pnfl', 'adress', 'bsual_tag'], 'safe'],
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
        $query = Animals::find();

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
            'cat_id' => $this->cat_id,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'vet_site_id' => $this->vet_site_id,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'bsual_tag', $this->bsual_tag]);

        return $dataProvider;
    }
}
