<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organizations;

/**
 * OrganizationsSearch represents the model behind the search form of `app\models\Organizations`.
 */
class OrganizationsSearch extends Organizations
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'state', 'district_id', 'type_id'], 'integer'],
            [['name','q'], 'safe'],
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
        $query = Organizations::find()
            ->innerJoin('state_list','organizations.state = state_list.id')
            ->innerJoin('districts','district_id = districts.id')
            ->innerJoin('organization_type','type_id = organization_type.id')
        ;

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
            'parent_id' => $this->parent_id,
            'state' => $this->state,
            'district_id' => $this->district_id,
            'type_id' => $this->type_id,
        ]);
        $query
            ->orFilterWhere(['like','state_list.name',$this->q])
            ->orFilterWhere(['like','organizations.name',$this->q])
            ->orFilterWhere(['like','districts.name',$this->q])
            ->orFilterWhere(['like','organization_type.name',$this->q])

            ;
        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
