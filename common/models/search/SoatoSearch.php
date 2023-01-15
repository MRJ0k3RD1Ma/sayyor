<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Soato;

/**
 * SoatoSearch represents the model behind the search form of `app\models\Soato`.
 */
class SoatoSearch extends Soato
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MHOBT_cod', 'res_id', 'region_id', 'district_id', 'qfi_id'], 'integer'],
            [['name_lot', 'center_lot', 'name_cyr', 'center_cyr', 'name_ru', 'center_ru','q'], 'safe'],
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

        /*// grid filtering conditions
        $query->orFilterWhere([
            'MHOBT_cod' => $this->q,
            'res_id' => $this->q,
            'region_id' => $this->q,
            'district_id' => $this->q,
            'qfi_id' => $this->q,
        ]);*/

        $query->orFilterWhere(['like', 'name_lot', $this->q])
            ->orFilterWhere(['like', 'center_lot', $this->q])
            ->orFilterWhere(['like', 'name_cyr', $this->q])
            ->orFilterWhere(['like', 'center_cyr', $this->q])
            ->orFilterWhere(['like', 'name_ru', $this->q])
            ->orFilterWhere(['like', 'MHOBT_cod', $this->q])
            ->orFilterWhere(['like', 'res_id', $this->q])
            ->orFilterWhere(['like', 'region_id', $this->q])
            ->orFilterWhere(['like', 'district_id', $this->q])
            ->orFilterWhere(['like', 'qfi_id', $this->q])
            ->orFilterWhere(['like', 'center_ru', $this->q]);

        return $dataProvider;
    }

    public function ListRegions(int $id = null)
    {
        $query = Soato::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if ($id) {
            $query->andWhere(['region_id' => $id])
                ->andWhere(['is', 'qfi_id', null])
                ->andWhere(['is not', 'district_id', null]);
        } else {
            $query->andWhere(['is not', 'region_id', null])
                ->andWhere(['is', 'district_id', null]);
        }

        return $dataProvider;
    }
}
