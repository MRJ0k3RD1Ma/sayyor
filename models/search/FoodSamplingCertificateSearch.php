<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FoodSamplingCertificate;

/**
 * FoodSamplingCertificateSearch represents the model behind the search form of `app\models\FoodSamplingCertificate`.
 */
class FoodSamplingCertificateSearch extends FoodSamplingCertificate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sampling_site', 'sampler_organization_code', 'sampler_person_pnfl', 'unit_id', 'verification_sample', 'verification_pupose_id', 'sampling_rules_id', 'sample_condition_id'], 'integer'],
            [['kod', 'pnfl', 'inn', 'sampling_adress', 'producer', 'serial_num', 'manufacture_date', 'sell_by', 'coments', 'sampling_date', 'send_sample_date', 'explanations'], 'safe'],
            [['count'], 'number'],
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
        $query = FoodSamplingCertificate::find();

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
            'sampling_site' => $this->sampling_site,
            'sampler_organization_code' => $this->sampler_organization_code,
            'sampler_person_pnfl' => $this->sampler_person_pnfl,
            'unit_id' => $this->unit_id,
            'count' => $this->count,
            'verification_sample' => $this->verification_sample,
            'manufacture_date' => $this->manufacture_date,
            'sell_by' => $this->sell_by,
            'verification_pupose_id' => $this->verification_pupose_id,
            'sampling_rules_id' => $this->sampling_rules_id,
            'sample_condition_id' => $this->sample_condition_id,
            'sampling_date' => $this->sampling_date,
            'send_sample_date' => $this->send_sample_date,
        ]);

        $query->andFilterWhere(['like', 'kod', $this->kod])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'sampling_adress', $this->sampling_adress])
            ->andFilterWhere(['like', 'producer', $this->producer])
            ->andFilterWhere(['like', 'serial_num', $this->serial_num])
            ->andFilterWhere(['like', 'coments', $this->coments])
            ->andFilterWhere(['like', 'explanations', $this->explanations]);

        return $dataProvider;
    }
}
