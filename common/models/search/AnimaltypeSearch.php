<?php

namespace common\models\search;

use common\models\AnimalCategory;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Animaltype;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * AnimaltypeSearch represents the model behind the search form of `app\models\Animaltype`.
 * @var $q
 */
class AnimaltypeSearch extends Animaltype
{
    public $q;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code'], 'integer'],
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
        $query = Animaltype::find();

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
            'code' => $this->code,
        ]);

        $query->orFilterWhere(['ilike', 'name_uz', $this->q])
            ->orFilterWhere(['ilike', 'name_ru', $this->q]);

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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Kod", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Nomi(O'zbek)", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Nomi(Rus)", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var Animaltype $item
             */
            $row++;
            $col = 1;
            $key++;
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
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
