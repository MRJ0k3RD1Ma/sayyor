<?php

namespace frontend\models\search\laboratory;

use common\models\DestructionSampleAnimal;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RouteSert;
use Yii;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;

/**
 * RouteSertSearch represents the model behind the search form of `common\models\RouteSert`.
 */
class RouteSertSearch extends RouteSert
{
    public $q;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'director_id', 'leader_id', 'executor_id', 'state_id', 'sample_id', 'registration_id', 'status_id'], 'integer'],
            [['q', 'deadline', 'ads', 'created', 'updated'], 'safe'],
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
        $query = RouteSert::find()->where(['executor_id' => Yii::$app->user->id])->orderBy(['created' => SORT_DESC]);

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
            'director_id' => $this->director_id,
            'leader_id' => $this->leader_id,
            'executor_id' => $this->executor_id,
            'deadline' => $this->deadline,
            'state_id' => $this->state_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'sample_id' => $this->sample_id,
            'registration_id' => $this->registration_id,

        ]);

        if ($this->status_id) {
            $query->andFilterWhere(['route_sert.status_id' => $this->status_id]);
        }
        $query->andFilterWhere(['like', 'ads', $this->ads]);
        if ($this->q) {
            $query->joinWith(['sample'])
                ->andFilterWhere(['like', 'samples.kod', $this->q]);
        }
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
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Bajaruvchi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Muddat", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Izoh", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Yaratildi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Status", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var RouteSert $item
             */
            $row++;
            $col = 1;
            $key++;
            $info = function ($model) {
                $d = $model->sample;
                $lg = 'uz';
                if (Yii::$app->language == 'ru') $lg = 'ru';
                $res = "";
                $res .= $d->animal->type->{'name_' . $lg} . "\n";
                $res .= Yii::t('lab', 'Holati:') . ' ' . $d->animal->cat->{'name_' . $lg} . "\n";
                $res .= Yii::t('lab', 'Jinsi:') . ' ' . Yii::$app->params['gender'][$d->animal->gender] . "\n";
                $d1 = new \DateTime($d->animal->birthday);
                $d2 = new \DateTime(date('Y-m-d'));
                $interval = $d1->diff($d2);
                $diff = $interval->m + ($interval->y * 12);
                $res .= Yii::t('lab', 'Tug\'ilgan sanasi:') . ' ' . $d->animal->birthday . '(' . $diff . ' oy)';

                return $res;
            };
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sample->kod, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->executor->name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->deadline, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->ads, DataType::TYPE_STRING);
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
}
