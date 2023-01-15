<?php

namespace common\models\search;

use common\models\FoodSamplingCertificate;
use common\models\VetSites;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\QueryInterface;
use yii\helpers\FileHelper;
use Yii;

/**
 * FoodSamplingCertificateSearch represents the model behind the search form of `common\models\FoodSamplingCertificate`.
 */
class FoodSamplingCertificateSearch extends FoodSamplingCertificate
{
    public $q;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'food_id', 'sampling_site', 'verification_pupose_id', 'based_public_information', 'message_number'], 'integer'],
            [['q', 'code', 'inn', 'pnfl', 'sampling_adress', 'sampler_person_pnfl', 'sampler_person_inn', 'sampling_date', 'send_sample_date', 'created', 'updated'], 'safe'],
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
        $query = FoodSamplingCertificate::find();

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
            'food_id' => $this->food_id,
            'sampling_site' => $this->sampling_site,
            'verification_pupose_id' => $this->verification_pupose_id,
            'sampling_date' => $this->sampling_date,
            'send_sample_date' => $this->send_sample_date,
            'based_public_information' => $this->based_public_information,
            'message_number' => $this->message_number,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'inn', $this->q])
            ->orFilterWhere(['like', 'pnfl', $this->q])
            ->orFilterWhere(['like', 'sampling_adress', $this->q])
            ->orFilterWhere(['like', 'sampler_person_pnfl', $this->q])
            ->orFilterWhere(['like', 'sampler_person_inn', $this->q]);

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
//        $speadsheet->getDefaultStyle()->getAlignment()->setWrapText(true);
        $row = 1;
        $col = 1;
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "#", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Raqami", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Buyurtmachi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna beruvchi vet uchastka", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna olish manzilil", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna oluvchi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna olish sanasi", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Namuna yuborilgan sana", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Xabar asosida tuzilgan", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Status", DataType::TYPE_STRING);
        $sheet->setCellValueExplicitByColumnAndRow($col++, $row, "Tashkilot", DataType::TYPE_STRING);
        $key = 0;
        $models = $query->all();
        foreach ($models as $item) {
            /**
             * @var FoodSamplingCertificate $item
             */
            $row++;
            $col = 1;
            $key++;

            $buyurtmachi = static function ($d) {
                if ($d->pnfl) {
                    return $d->pnfl . "\n" . $d->pnfl0->name . ' ' . $d->pnfl0->surname . ' ' . $d->pnfl0->middlename;
                } elseif ($d->inn) {
                    return $d->inn . "\n" . $d->inn0->name;
                } else return null;
            };
            $manzil = static function ($d) {
                $lang = Yii::$app->language;
                $ads = 'lot';
                if ($lang == 'ru') {
                    $ads = 'ru';
                } elseif ($lang == 'uz') {
                    $ads = 'lot';
                } else {
                    $ads = 'cyr';
                }
                return \common\models\Soato::Full($d->samplingSite->soato) . ' ' . $d->sampling_adress;
            };
            $namuna_oluvchi = static function ($d) {
                if ($d->sampler_person_pnfl) {
                    return $d->sampler_person_pnfl . "\n" . @$d->personPnfl->name . ' ' . @$d->personPnfl->surname . ' ' . @$d->personPnfl->middlename;
                } elseif ($d->sampler_person_inn) {
                    return $d->sampler_person_inn . "\n" . $d->personInn->name;
                } else return null;
            };
            $information = static function ($d) {
                if ($d->based_public_information == 0) {
                    return Yii::t('client', 'Yo\'q');
                } else {
                    return Yii::t('client', 'Ha') . "\n" . '№' . $d->message_number;
                }
            };
            $status = function ($d) {
                $lg = 'uz';
                if (Yii::$app->language == 'ru') {
                    $lg = 'ru';
                }
                return @$d->status->{'name_' . $lg};
            };
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $key, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->code, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $buyurtmachi($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->samplingSite->name, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $manzil($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $namuna_oluvchi($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->sampling_date, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->send_sample_date, DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $information($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $status($item), DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow($col++, $row, $item->org->NAME_FULL, DataType::TYPE_STRING);
        }
        $name = 'ExcelReport-' . \Yii::$app->formatter->asDatetime(time(), 'php:d_m_Y_h_i_s') . '.xlsx';
        $writer = new Xlsx($speadsheet);
        $dir = \Yii::getAlias('@tmp/excel');
        if (!is_dir($dir)) {
            FileHelper::createDirectory($dir, 0777);
        }
        $fileName = $dir . DIRECTORY_SEPARATOR . $name;
        $writer->save($fileName);
        return \Yii::$app->response->sendFile($fileName);
    }

    public function searchRegion($params)
    {
        $query = FoodSamplingCertificate::find();

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
        $query->andWhere('sampling_site in (select id from vet_sites where soato like \'%'.$MHOBT_cod.'%\')');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'food_id' => $this->food_id,
            'sampling_site' => $this->sampling_site,
            'verification_pupose_id' => $this->verification_pupose_id,
            'sampling_date' => $this->sampling_date,
            'send_sample_date' => $this->send_sample_date,
            'based_public_information' => $this->based_public_information,
            'message_number' => $this->message_number,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'inn', $this->q])
            ->orFilterWhere(['like', 'pnfl', $this->q])
            ->orFilterWhere(['like', 'sampling_adress', $this->q])
            ->orFilterWhere(['like', 'sampler_person_pnfl', $this->q])
            ->orFilterWhere(['like', 'sampler_person_inn', $this->q]);

        return $dataProvider;
    }
    public function searchDistrict($params)
    {
        $query = FoodSamplingCertificate::find();

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
//        $vetSites = VetSites::find()->select(['distinct(id)'])->where(['like', 'soato', $MHOBT_cod])->column();
        $query->andWhere('sampling_site in (select id from vet_sites where soato like \'%'.$MHOBT_cod.'%\')');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'food_id' => $this->food_id,
            'sampling_site' => $this->sampling_site,
            'verification_pupose_id' => $this->verification_pupose_id,
            'sampling_date' => $this->sampling_date,
            'send_sample_date' => $this->send_sample_date,
            'based_public_information' => $this->based_public_information,
            'message_number' => $this->message_number,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->orFilterWhere(['like', 'code', $this->q])
            ->orFilterWhere(['like', 'inn', $this->q])
            ->orFilterWhere(['like', 'pnfl', $this->q])
            ->orFilterWhere(['like', 'sampling_adress', $this->q])
            ->orFilterWhere(['like', 'sampler_person_pnfl', $this->q])
            ->orFilterWhere(['like', 'sampler_person_inn', $this->q]);

        return $dataProvider;
    }
}
