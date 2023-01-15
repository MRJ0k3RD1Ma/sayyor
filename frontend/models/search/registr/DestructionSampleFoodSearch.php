<?php

namespace app\models\search\registr;

use common\models\DestructionSampleAnimal;
use Yii;
use common\models\RouteSert;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DestructionSampleFood;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * DestructionSampleFoodSearch represents the model behind the search form of `common\models\DestructionSampleFood`.
 */
class DestructionSampleFoodSearch extends DestructionSampleFood
{
    public $q;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code_id', 'sample_id', 'creator_id', 'consent_id', 'state_id', 'org_id'], 'integer'],
            [['q', 'code', 'destruction_date', 'ads', 'created', 'updated', 'approved_date'], 'safe'],
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
        $query = DestructionSampleFood::find();

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
            'code_id' => $this->code_id,
            'sample_id' => $this->sample_id,
            'destruction_date' => $this->destruction_date,
            'creator_id' => $this->creator_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'consent_id' => $this->consent_id,
            'approved_date' => $this->approved_date,
            'state_id' => $this->state_id,
            'org_id' => $this->org_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    public function searchRegister($params)
    {
        $query = DestructionSampleFood::find()->orderBy(['state_id' => SORT_DESC, 'created' => SORT_DESC]);

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
            'code_id' => $this->code_id,
            'sample_id' => $this->sample_id,
            'destruction_date' => $this->destruction_date,
            'creator_id' => $this->creator_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'consent_id' => $this->consent_id,
            'approved_date' => $this->approved_date,
            'org_id' => $this->org_id,
        ]);

        if ($this->state_id) {
            $query->andFilterWhere([
                'destruction_sample_food.state_id' => $this->state_id
            ]);
        }
        if ($this->q) {
            $query->joinWith('sample')
                ->andFilterWhere(['like', 'food_samples.samp_code', $this->q]);
        }
        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'ads', $this->ads]);

        return $dataProvider;
    }

    /**
     * @throws \yii\base\Exception
     * @throws Exception
     * @throws InvalidConfigException
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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Raqami", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Izoh", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Tasdiqladi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna yo'q qilingan sana", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Holat", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var DestructionSampleFood $item
             */
            $row++;
            $col = 1;
            $key++;
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->consent->name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sample->samp_code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->ads, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->destruction_date, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, DestructionSampleAnimal::ListStatus()[$item->state_id], DataType::TYPE_STRING);
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
}
