<?php

namespace common\models\search;

use common\models\SampleTypes;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SampleBoxes;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * SampleBoxesSearch represents the model behind the search form of `app\models\SampleBoxes`.
 * @var $q
 */
class SampleBoxesSearch extends SampleBoxes
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['name_uz', 'name_ru','q'], 'safe'],
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
        $query = SampleBoxes::find();

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
        ]);

        $query->orFilterWhere(['like', 'name_uz', $this->q])
            ->orFilterWhere(['like', 'name_ru', $this->q]);

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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Nomi(O'zbek)", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Nomi(Rus)", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var SampleBoxes $item
             */
            $row++;
            $col = 1;
            $key++;
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->name_uz, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->name_ru, DataType::TYPE_STRING);
        }
        $name = 'ExcelReport.xlsx';
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
