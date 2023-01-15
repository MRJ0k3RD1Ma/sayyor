<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TamplateAnimal;

/**
 * TamplateAnimalSearch represents the model behind the search form of `common\models\TamplateAnimal`.
 */
class TamplateAnimalSearch extends TamplateAnimal
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'diseases_id', 'test_method_id', 'unit_id', 'is_vaccination', 'dead_days', 'creator_id', 'consent_id', 'state_id'], 'integer'],
            [['name_uz', 'name_ru', 'min', 'min_1', 'max', 'max_1', 'created', 'updated'], 'safe'],
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
        $query = TamplateAnimal::find();

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
            'diseases_id' => $this->diseases_id,
            'test_method_id' => $this->test_method_id,
            'unit_id' => $this->unit_id,
            'is_vaccination' => $this->is_vaccination,
            'dead_days' => $this->dead_days,
            'creator_id' => $this->creator_id,
            'consent_id' => $this->consent_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'state_id' => $this->state_id,
        ]);

        $query->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'min', $this->min])
            ->andFilterWhere(['like', 'min_1', $this->min_1])
            ->andFilterWhere(['like', 'max', $this->max])
            ->andFilterWhere(['like', 'max_1', $this->max_1]);

        return $dataProvider;
    }
}
