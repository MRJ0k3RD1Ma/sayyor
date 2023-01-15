<?php

namespace common\models\search;

use common\models\SampleRegistration;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodRegistration;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;
use Yii;
/**
 * FoodRegistrationSearch represents the model behind the search form of `common\models\FoodRegistration`.
 */
class FoodRegistrationSearch extends FoodRegistration
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'organization_id', 'is_research', 'code_id', 'research_category_id', 'results_conformity_id', 'emp_id', 'status_id'], 'integer'],
            [['inn', 'pnfl', 'code', 'reg_date', 'sender_name', 'sender_phone', 'created', 'updated', 'ads'], 'safe'],
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
        $query = FoodRegistration::find()->orderBy(['created'=>SORT_DESC]);

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
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'reg_date', $this->reg_date])
            ->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }
    public function exportToExcel(?QueryInterface $query)
    {
        $speadsheet = new Spreadsheet();
        $sheet = $speadsheet->getActiveSheet();
        $title = "Sheet1";
        $sheet->setTitle(substr($title, 0, 31));
        $row = 1;
        $col = 1;
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "#", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Raqami", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna raqamlari", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Laboratoriya", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Shoshilinch tekshiruv", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Kategoriyasi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Ariza yuboruvchi F.I.O", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Ariza yuboruvchi telefoni ", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Yaratildi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Holat", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var FoodRegistration $item
             */
            $row++;
            $col = 1;
            $key++;
            $fio = function ($d) {
                if ($d->inn) {
                    return $d->inn . '<br>' . $d->inn0->name;
                } elseif ($d->pnfl) {
                    return $d->pnfl . '<br>' . $d->pnfl0->name . ' ' . $d->pnfl0->surname . ' ' . $d->pnfl0->middlename;
                } else {
                    return null;
                }
            };
            $research = function ($d) {
                $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                return $s[$d->is_research];
            };
            $codes = function($d){
                $res = "";
                foreach ($d as $item){
                    $res .= $item->samp_code.'; ';
                }
                return $res;
            };
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $codes($item->samples), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->organization->NAME_FULL, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $research($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->researchCategory->name_uz, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sender_name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sender_phone, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->created, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->status->name_uz, DataType::TYPE_STRING);
        }
        $name = 'ExcelReport-' . Yii::$app->formatter->asDatetime(time(), 'php:d_m_Y_h_i_s') . '.xlsx';
        $writer = new Xlsx($speadsheet);
        $dir = Yii::getAlias('@tmp/excel');
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir, 0777);
        }
        $fileName = $dir . DIRECTORY_SEPARATOR . $name;
        $writer->save($fileName);
        return Yii::$app->response->sendFile($fileName);
    }


    public function searchLeader($params)
    {
        $query = FoodRegistration::find()->select(['food_registration.*','food_route.status_id as route_status'])
            ->innerJoin('food_route','food_route.registration_id = food_registration.id and food_route.leader_id = '.Yii::$app->user->id)
            ->groupBy('food_registration.id')
            ->orderBy(['food_registration.created'=>SORT_DESC]);

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
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'food_route.status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'reg_date', $this->reg_date])
            ->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'code', $this->q]);

        return $dataProvider;
    }


    public function searchLab($params)
    {
        $query = FoodRegistration::find()->select(['food_registration.*','food_route.status_id as route_status'])
            ->innerJoin('food_route','food_route.registration_id = food_registration.id and food_route.executor_id = '.Yii::$app->user->id)
            ->groupBy('food_registration.id')
            ->orderBy(['food_registration.created'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->status_id != -1){
            $query->andWhere(['food_route.status_id'=>$this->status_id]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'food_route.status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'reg_date', $this->reg_date])
            ->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'code', $this->q]);

        return $dataProvider;
    }

    public function searchDirector($params)
    {
        $query = FoodRegistration::find()->select(['food_registration.*','food_route.status_id as route_status'])
            ->innerJoin('food_route','food_route.registration_id = food_registration.id and food_route.director_id = '.Yii::$app->user->id)
            ->groupBy('food_registration.id')
            ->orderBy(['food_registration.created'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->status_id != -1){
            $query->andWhere(['food_route.status_id'=>$this->status_id]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'organization_id' => $this->organization_id,
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'food_route.status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'pnfl', $this->pnfl])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'reg_date', $this->reg_date])
            ->andFilterWhere(['like', 'sender_name', $this->sender_name])
            ->andFilterWhere(['like', 'sender_phone', $this->sender_phone])
            ->andFilterWhere(['like', 'code', $this->q]);

        return $dataProvider;
    }
}
