<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TemplateFood;

/**
 * TemplateFoodSearch represents the model behind the search form of `common\models\TemplateFood`.
 */
class TemplateFoodSearch extends TemplateFood
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'food_id', 'group_id', 'unit_id'], 'integer'],
            [['name_ru', 'name_uz', 'min_1', 'min_2', 'max_1', 'max_2'], 'safe'],
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
        $query = TemplateFood::find();

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
            'category_id' => $this->category_id,
            'food_id' => $this->food_id,
            'group_id' => $this->group_id,
            'unit_id' => $this->unit_id,
        ]);

        $query->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'min_1', $this->min_1])
            ->andFilterWhere(['like', 'min_2', $this->min_2])
            ->andFilterWhere(['like', 'max_1', $this->max_1])
            ->andFilterWhere(['like', 'max_2', $this->max_2]);

        return $dataProvider;
    }
}
