<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Individuals;

/**
 * IndividualsSearch represents the model behind the search form of `app\models\Individuals`.
 */
class IndividualsSearch extends Individuals
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pnfl', 'name', 'surname', 'middlename', 'adress', 'passport'], 'safe'],
            [['soato_id'], 'integer'],
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
        $query = Individuals::find();

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
            'soato_id' => $this->soato_id,
        ]);

        $query->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'middlename', $this->middlename])
            ->andFilterWhere(['like', 'adress', $this->adress])
            ->andFilterWhere(['like', 'passport', $this->passport]);

        return $dataProvider;
    }
}
