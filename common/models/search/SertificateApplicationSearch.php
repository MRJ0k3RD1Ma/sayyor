<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SertificateApplication;

/**
 * SertificateApplicationSearch represents the model behind the search form of `app\models\SertificateApplication`.
 */
class SertificateApplicationSearch extends SertificateApplication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fsc_id', 'vet_site_id', 'labaratory_test_type_id', 'emergency_check', 'cat_id', 'phone', 'name', 'check_date', 'status'], 'integer'],
            [['code', 'pnfl', 'inn'], 'safe'],
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
        $query = SertificateApplication::find();

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
            'fsc_id' => $this->fsc_id,
            'vet_site_id' => $this->vet_site_id,
            'labaratory_test_type_id' => $this->labaratory_test_type_id,
            'emergency_check' => $this->emergency_check,
            'cat_id' => $this->cat_id,
            'phone' => $this->phone,
            'name' => $this->name,
            'check_date' => $this->check_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'inn', $this->inn]);

        return $dataProvider;
    }
}
