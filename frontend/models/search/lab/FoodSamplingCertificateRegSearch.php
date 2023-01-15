<?php

namespace frontend\models\search\lab;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodSamplingCertificate;

/**
 * FoodSamplingCertificateSearch represents the model behind the search form of `app\models\FoodSamplingCertificate`.
 */
class FoodSamplingCertificateRegSearch extends FoodSamplingCertificate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'organization_id', 'sampling_site', 'sampler_organization_code', 'sampler_person_pnfl', 'unit_id', 'verification_sample', 'verification_pupose_id', 'sample_box_id', 'sample_condition_id', 'based_public_information', 'message_number', 'laboratory_test_type_id'], 'integer'],
            [['kod', 'pnfl', 'sampling_adress', 'producer', 'serial_num', 'manufacture_date', 'sell_by', 'coments', 'sampling_date', 'send_sample_date', 'explanations'], 'safe'],
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
        $query = FoodSamplingCertificate::find()->where(['organization_id'=>\Yii::$app->user->identity->empPosts->org_id])->orderBy(['created'=>SORT_DESC]);

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
            'organization_id' => $this->organization_id,
            'sampling_site' => $this->sampling_site,
            'sampler_organization_code' => $this->sampler_organization_code,
            'sampler_person_pnfl' => $this->sampler_person_pnfl,
            'unit_id' => $this->unit_id,
            'count' => $this->count,
            'verification_sample' => $this->verification_sample,
            'manufacture_date' => $this->manufacture_date,
            'sell_by' => $this->sell_by,
            'verification_pupose_id' => $this->verification_pupose_id,
            'sample_box_id' => $this->sample_box_id,
            'sample_condition_id' => $this->sample_condition_id,
            'sampling_date' => $this->sampling_date,
            'send_sample_date' => $this->send_sample_date,
            'based_public_information' => $this->based_public_information,
            'message_number' => $this->message_number,
            'laboratory_test_type_id' => $this->laboratory_test_type_id,
        ]);

        $query->andFilterWhere(['like', 'kod', $this->kod])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'sampling_adress', $this->sampling_adress])
            ->andFilterWhere(['like', 'producer', $this->producer])
            ->andFilterWhere(['like', 'serial_num', $this->serial_num])
            ->andFilterWhere(['like', 'coments', $this->coments])
            ->andFilterWhere(['like', 'explanations', $this->explanations]);

        return $dataProvider;
    }
}
