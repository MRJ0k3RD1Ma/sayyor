<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Samples;

/**
 * SamplesSearch represents the model behind the search form of `app\models\Samples`.
 */
class SamplesSearch extends Samples
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sample_type_is', 'sample_box_id', 'animal_id', 'sert_id'], 'integer'],
            [['kod', 'label'], 'safe'],
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
        $query = Samples::find();

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
            'sample_type_is' => $this->sample_type_is,
            'sample_box_id' => $this->sample_box_id,
            'animal_id' => $this->animal_id,
            'sert_id' => $this->sert_id,
        ]);

        $query->andFilterWhere(['like', 'kod', $this->kod])
            ->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}
