<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Complex;

/**
 * ComplexSearch represents the model behind the search form about `app\models\Complex`.
 */
class ComplexSearch extends Complex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'register_id', 'director_id', 'status', 'isDelete'], 'integer'],
            [['code', 'name', 'phone', 'telegram', 'chat_id', 'email', 'fax', 'created', 'updated', 'setting'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Complex::find();

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
            'register_id' => $this->register_id,
            'director_id' => $this->director_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status' => $this->status,
            'isDelete' => $this->isDelete,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'chat_id', $this->chat_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'setting', $this->setting]);

        return $dataProvider;
    }
}
