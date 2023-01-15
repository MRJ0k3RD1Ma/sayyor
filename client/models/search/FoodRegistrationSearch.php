<?php

namespace client\models\search;

use common\models\Organizations;
use common\models\SampleRegistration;
use common\models\Samples;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodRegistration;
use Yii;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

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
            [['inn', 'pnfl', 'code', 'q', 'reg_date', 'sender_name', 'sender_phone', 'created', 'updated', 'ads'], 'safe'],
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
        if (Yii::$app->session->getFlash('doc_type') == 'inn') {
            $query = FoodRegistration::find()->where(['inn' => Yii::$app->session->get('doc_inn')])->orderBy(['created' => SORT_DESC]);
        } else {
            $query = FoodRegistration::find()->where(['pnfl' => Yii::$app->session->get('doc_pnfl')])->orderBy(['created' => SORT_DESC]);
        }
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

        $query
            ->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'reg_date', $this->q])
            ->orFilterWhere(['like', 'sender_name', $this->q])
            ->orFilterWhere(['like', 'sender_phone', $this->q])
            ->orFilterWhere(['like', 'ads', $this->q]);

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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Kod", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna raqamlari", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Laboratoriya", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Shoshilinch tekshiruv", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Tekshiruv turi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Ariza yuboruvchi F.I.O", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Yuborilgan vaqti", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var SampleRegistration $item
             */
            $row++;
            $col = 1;
            $key++;
            $sampleout = '';
            foreach (Samples::find()->where(['sert_id' => $item->id])->all() as $sample) {
                $sampleout .= $sample->status->icon . " " . $sample->code . "<br>";
            }
            $research = function ($d) {
                $s = [0 => 'Shoshilinch emas', 1 => 'Shohilinch'];
                return $s[$d->is_research];
            };
            $namunalar = function ($a) {
                $res = "";
                foreach ($a->comp as $item) {
                    $res .= $item->sample->samp_code . "; ";
                }
                return $res;
            };

            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $namunalar($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->organization->NAME_FULL, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $research($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->researchCategory->name_uz, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sender_name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sender_phone, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->created, DataType::TYPE_STRING);
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

    public function searchRegion($params)
    {
        $query = FoodRegistration::find();
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

        $MHOBT_cod = Yii::$app->user->identity->posts->org->soato0->res_id . Yii::$app->user->identity->posts->org->soato0->region_id;
        $Organizations = Organizations::find()->select(['distinct(id)'])->where(['like', 'soato', $MHOBT_cod])->column();
        $query->andFilterWhere([
            'organization_id' => $Organizations
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
        ]);

        $query
            ->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'reg_date', $this->q])
            ->orFilterWhere(['like', 'sender_name', $this->q])
            ->orFilterWhere(['like', 'sender_phone', $this->q])
            ->orFilterWhere(['like', 'ads', $this->q]);

        return $dataProvider;
    }

    public function searchDistrict($params)
    {
        $query = FoodRegistration::find();
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

        $MHOBT_cod = Yii::$app->user->identity->posts->org->soato0->res_id . Yii::$app->user->identity->posts->org->soato0->region_id.Yii::$app->user->identity->posts->org->soato0->district_id;
        $Organizations = Organizations::find()->select(['distinct(id)'])->where(['like', 'soato', $MHOBT_cod])->column();
        $query->andFilterWhere([
            'organization_id' => $Organizations
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_research' => $this->is_research,
            'code_id' => $this->code_id,
            'research_category_id' => $this->research_category_id,
            'results_conformity_id' => $this->results_conformity_id,
            'emp_id' => $this->emp_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'status_id' => $this->status_id,
        ]);

        $query
            ->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'reg_date', $this->q])
            ->orFilterWhere(['like', 'sender_name', $this->q])
            ->orFilterWhere(['like', 'sender_phone', $this->q])
            ->orFilterWhere(['like', 'ads', $this->q]);

        return $dataProvider;
    }
}
