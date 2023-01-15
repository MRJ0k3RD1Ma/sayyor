<?php

namespace common\models\search;

use common\models\VetSites;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organizations;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * OrganizationsSearch represents the model behind the search form of `app\models\Organizations`.
 * @var $q
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
            [['id', 'id_from_api', 'TIN', 'NA1_CODE', 'NS10_CODE', 'NS11_CODE', 'TELEFON', 'GD_TIN', 'GD_TEL_WORK', 'OKED', 'OKPO', 'OKONX', 'soato'], 'integer'],
            [['q', 'NAME_FULL', 'ADDRESS', 'REG_DATE', 'DATE_TIN', 'REG_NUM', 'NS13_CODE', 'TELEX', 'FAX', 'GD_FULL_NAME', 'GD_EMAIL', 'GB_FULL_NAME', 'GB_TIN', 'GB_TEL_WORK', 'GB_TEL_HOME', 'EMAIL', 'DATE_END', 'CREATED', 'CHANGED', 'GD_MOBILE'], 'safe'],
            [['GD_TEL_HOME', 'BUDJET'], 'boolean'],
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
        $query = Organizations::find();

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
            'id_from_api' => $this->id_from_api,
            'TIN' => $this->TIN,
            'NA1_CODE' => $this->NA1_CODE,
            'NS10_CODE' => $this->NS10_CODE,
            'NS11_CODE' => $this->NS11_CODE,
            'REG_DATE' => $this->REG_DATE,
            'DATE_TIN' => $this->DATE_TIN,
            'TELEFON' => $this->TELEFON,
            'GD_TIN' => $this->GD_TIN,
            'GD_TEL_WORK' => $this->GD_TEL_WORK,
            'GD_TEL_HOME' => $this->GD_TEL_HOME,
            'OKED' => $this->OKED,
            'OKPO' => $this->OKPO,
            'OKONX' => $this->OKONX,
            'soato' => $this->soato,
            'DATE_END' => $this->DATE_END,
            'CREATED' => $this->CREATED,
            'CHANGED' => $this->CHANGED,
            'BUDJET' => $this->BUDJET,
        ]);

        $query->orFilterWhere(['like', 'NAME_FULL', $this->q]);

        $query->andFilterWhere(['like', 'NAME_FULL', $this->NAME_FULL])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'REG_NUM', $this->REG_NUM])
            ->andFilterWhere(['like', 'NS13_CODE', $this->NS13_CODE])
            ->andFilterWhere(['like', 'TELEX', $this->TELEX])
            ->andFilterWhere(['like', 'FAX', $this->FAX])
            ->andFilterWhere(['like', 'GD_FULL_NAME', $this->GD_FULL_NAME])
            ->andFilterWhere(['like', 'GD_EMAIL', $this->GD_EMAIL])
            ->andFilterWhere(['like', 'GB_FULL_NAME', $this->GB_FULL_NAME])
            ->andFilterWhere(['like', 'GB_TIN', $this->GB_TIN])
            ->andFilterWhere(['like', 'GB_TEL_WORK', $this->GB_TEL_WORK])
            ->andFilterWhere(['like', 'GB_TEL_HOME', $this->GB_TEL_HOME])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'GD_MOBILE', $this->GD_MOBILE]);

        return $dataProvider;
    }

    /**
     * @throws Exception
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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "ID", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "STIR(INN)", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Tashkilot nomi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Manzil", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Telefon", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var Organizations $item
             */
            $row++;
            $col = 1;
            $key++;
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->id, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->TIN, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->NAME_FULL, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->ADDRESS, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->FAX, DataType::TYPE_STRING);
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
