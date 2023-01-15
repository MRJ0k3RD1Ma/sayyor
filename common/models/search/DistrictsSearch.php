<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Districts;

/**
 * DistrictsSearch represents the model behind the search form of `app\models\Districts`.
 */
class DistrictsSearch extends Districts
{
    public $regions;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'type'], 'integer'],
            [['name','regions',], 'safe'],
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
        $query = Districts::find()->innerJoin('regions','regions.id=districts.region_id');

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
            'region_id' => $this->region_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'regions.name', $this->regions]);

        return $dataProvider;
    }
}
