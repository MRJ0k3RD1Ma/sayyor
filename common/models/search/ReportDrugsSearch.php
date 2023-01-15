<?php

namespace common\models\search;

use common\models\ReportAnimal;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReportDrugs;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * ReportDrugsSearch represents the model behind the search form of `common\models\ReportDrugs`.
 */
class ReportDrugsSearch extends ReportDrugs
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rep_id', 'cat_id', 'type_id', 'soato_id', 'operator_id', 'is_true', 'status_id'], 'integer'],
            [['q','code', 'lat', 'long', 'detail', 'phone', 'created', 'updated'], 'safe'],
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
        $query = ReportDrugs::find()->orderBy(['created'=>SORT_DESC]);

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
            'rep_id' => $this->rep_id,
            'cat_id' => $this->cat_id,
            'type_id' => $this->type_id,
            'soato_id' => $this->soato_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'operator_id' => $this->operator_id,
            'is_true' => $this->is_true,
            'status_id' => $this->status_id,
        ]);

        $query->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'lat', $this->q])
            ->orFilterWhere(['like', 'long', $this->q])
            ->orFilterWhere(['like', 'detail', $this->q])
            ->orFilterWhere(['like', 'phone', $this->q]);

        return $dataProvider;
    }

    public function searchSub($params)
    {
        $query = ReportDrugs::find()->filterWhere(['like','soato_id',\Yii::$app->user->identity->empPosts->org->soato])->orderBy(['created'=>SORT_DESC]);

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
            'rep_id' => $this->rep_id,
            'cat_id' => $this->cat_id,
            'type_id' => $this->type_id,
            'soato_id' => $this->soato_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'operator_id' => $this->operator_id,
            'is_true' => $this->is_true,
            'status_id' => $this->status_id,
        ]);

        $query->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'lat', $this->q])
            ->orFilterWhere(['like', 'long', $this->q])
            ->orFilterWhere(['like', 'detail', $this->q])
            ->orFilterWhere(['like', 'phone', $this->q]);

        return $dataProvider;
    }
    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \yii\base\Exception
     */
    public function exportToExcel(?QueryInterface $query)
    {
        $speadsheet = new Spreadsheet();
        $sheet = $speadsheet->getActiveSheet();
        $title = "Sheet1";
        $sheet->setTitle(substr($title, 0, 31));
        $row = 1;
        $col = 1;
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "#", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Code  ", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Turi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Holati", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Manzil", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Telefon", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Status", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Operator", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var ReportAnimal $item
             */
            $row++;
            $col = 1;
            $key++;
            $type=static function ($model) {
                return \common\models\ReportDrugType::find()->where(['id' => $model->type_id])->one()->name_uz;
            };
            $cate=static function ($model) {
                return \common\models\ReportFoodCategory::find()->where(['id' => $model->cat_id])->one()->name_uz;
            };
            $soato=static function ($model) {
                return \common\models\Soato::Full($model->soato_id);
            };
            $status=static function ($model) {
                return \common\models\ReportStatus::findOne(['id' => $model->status_id])->name_uz;
            };
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $type($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $cate($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $soato($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->phone, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $status($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->operator_id, DataType::TYPE_STRING);
        }
        $name = 'ExcelReport.xlsx';
        $writer = new Xlsx($speadsheet);
        $dir = \Yii::getAlias('@tmp/excel');
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir, 0777);
        }
        $fileName = $dir . DIRECTORY_SEPARATOR . $name;
        $writer->save($fileName);
        return \Yii::$app->response->sendFile($fileName);
    }
}
