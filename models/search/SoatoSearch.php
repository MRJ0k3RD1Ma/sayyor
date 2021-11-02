<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Soato;

/**
 * SoatoSearch represents the model behind the search form of `app\models\Soato`.
 */
class SoatoSearch extends Soato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'MHOBT_cod', 'res_id', 'region_id', 'district_id', 'qfi_id'], 'integer'],
            [['name_lot', 'center_lot', 'name_cyr', 'center_cyr', 'name_ru', 'center_ru'], 'safe'],
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
        $query = Soato::find();

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
            'MHOBT_cod' => $this->MHOBT_cod,
            'res_id' => $this->res_id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'qfi_id' => $this->qfi_id,
        ]);

        $query->andFilterWhere(['like', 'name_lot', $this->name_lot])
            ->andFilterWhere(['like', 'center_lot', $this->center_lot])
            ->andFilterWhere(['like', 'name_cyr', $this->name_cyr])
            ->andFilterWhere(['like', 'center_cyr', $this->center_cyr])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'center_ru', $this->center_ru]);

        return $dataProvider;
    }
}
