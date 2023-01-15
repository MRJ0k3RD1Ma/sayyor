<?php

namespace app\modules\district\controllers;

use client\models\search\FoodRegistrationSearch;
use client\models\search\SampleRegistrationSearch;
use client\models\search\SertificatesSearch;
use common\models\Animals;
use common\models\CompositeSamples;

use common\models\DestructionSampleAnimal;
use common\models\DestructionSampleFood;
use common\models\Emlash;
use common\models\FoodRegistration;
use common\models\FoodSamples;
use common\models\FoodSamplingCertificate;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\LoginForm;
use common\models\ProductExpertise;
use common\models\ReportAnimal;
use common\models\ReportDrugs;
use common\models\ReportFood;
use common\models\SampleRegistration;
use common\models\Samples;
use common\models\search\FoodSamplingCertificateSearch;
use common\models\search\ReportAnimalSearch;
use common\models\search\ReportDrugsSearch;
use common\models\search\ReportFoodSearch;
use common\models\search\SoatoSearch;
use common\models\Sertificates;
use common\models\SertStatus;
use common\models\Soato;
use common\models\Vaccination;
use common\models\VetSites;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    function actionListanimal(int $export = null)
    {

        $searchModel = new SertificatesSearch();
        $dataProvider = $searchModel->searchdistrict($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfanimal', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('listanimal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public
    function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate($type = null)
    {
        if ($type) {
            return $this->redirect(['/default/' . $type]);
        }
        return $this->render('create');
    }

    public function actionAnimal()
    {
        $model = new Sertificates();
        $legal = Individuals::findOne(['pnfl' => Yii::$app->session->get('doc_pnfl')]);
        $model->sert_date = date('Y-m-d');
        $model->ownertype = 1;
        $owner_leg = new LegalEntities();
        $owner_ind = new Individuals();
        $model->status_id = 0;
        if ($model->load(Yii::$app->request->post())) {

            $num = Sertificates::find()->filterWhere(['like', 'sert_date', date('Y')])->max('sert_id');
            $vet = VetSites::findOne($model->vet_site_id);
            $code = $vet->soato0->region_id . $vet->soato0->district_id . '-' . substr(date('Y'), 2, 2) . '-';

            $num = $num + 1;
            $code .= $num;
            $model->sert_id = "$num";
            $model->pnfl = $legal->pnfl;
            $model->sert_full = $code;
            $model->sert_num = "{$model->sert_num}";

            if ($model->ownertype == 1) {
                if ($owner_ind->load(Yii::$app->request->post())) {
                    if ($own = Individuals::findOne(['pnfl' => $owner_ind->pnfl])) {
                        $owner_ind = $own;
                    } else {
                        $owner_ind->save();
                    }
                    $model->owner_pnfl = $owner_ind->pnfl;
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('client', 'Ma\'lumotlarni to\'ldirishda xatolik'));
                }
            } elseif ($model->ownertype == 2) {
                if ($owner_leg->load(Yii::$app->request->post())) {
                    if ($own = LegalEntities::findOne(['inn' => $owner_leg->inn])) {
                        $owner_leg = $own;
                    } else {
                        $owner_leg->save();
                    }
                    $model->owner_inn = $owner_leg->inn;
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('client', 'Ma\'lumotlarni to\'ldirishda xatolik'));
                }
            } else {
                Yii::$app->session->setFlash('error', Yii::t('client', 'Ma\'lumotlarni to\'ldirishda xatolik'));
                return $this->render('animal', [
                    'model' => $model,
                    'legal' => $owner_leg,
                    'default' => $owner_ind
                ]);
            }


            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Proba tekshiruvchi tashkilotga muvoffaqtiyatli yuborildi');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ma\'lumotlarni to\'ldirishda xatolik yuzaga keldi');
            }
        }

        return $this->render('animal', [
            'model' => $model,
            'legal' => $owner_leg,
            'default' => $owner_ind
        ]);
    }

    public
    function actionViewanimal($id)
    {
        return $this->render('viewanimal', [
            'model' => $this->findModel($id),
        ]);
    }


    public
    function actionSend($id)
    {
        $model = Sertificates::findOne($id);
        $sample = Samples::find()->where(['samples.sert_id' => $id])->andWhere(['not in', 'samples.id', 'select cs.sample_id from composite_samples cs where samples.id=cs.sample_id'])->all();
        $reg = new SampleRegistration();
        $reg->pnfl = Yii::$app->session->get('doc_pnfl');
        $reg->pnfl = "{$reg->pnfl}";
        $reg->reg_date = date('Y-m-d');

        if ($reg->load(Yii::$app->request->post())) {

            $num = SampleRegistration::find()->filterWhere(['like', 'reg_date', date('Y')])->max('code_id');
            $reg->pnfl = Yii::$app->session->get('doc_pnfl');
            $reg->pnfl = "{$reg->pnfl}";
            $code = substr(date('Y'), 2, 2) . '-1-' . get3num($reg->organization_id) . '-';
            $reg->status_id = 1;
            $num = $num + 1;
            $code .= $num;
            $reg->code = $code;
            $reg->code_id = $num;

            if (is_array($reg->composite) and count($reg->composite) > 0) {
                if ($reg->save()) {
                    foreach ($reg->composite as $item) {
                        $com = new CompositeSamples();
                        $com->status_id = 1;
                        $com->sample_id = $item;
                        $com->registration_id = $reg->id;
                        $com->save();
                        $sam = Samples::findOne($com->sample_id);
                        $sam->status_id = 1;
                        $sam->save();
                        $sam = null;
                        $com = null;

                    }
                }
                $model->status_id = 1;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('client', 'Namuna tanlanmagan'));
            }

        }
        return $this->render('send', [
            'sample' => $sample,
            'model' => $model,
            'reg' => $reg
        ]);
    }

    public
    function actionAdd($id)
    {

        $model = $this->findModel($id);

        $animal = new Animals();
        $sample = new Samples();

        $animal->pnfl = Yii::$app->session->get('doc_pnfl');
        $sample->animal_id = -1;

        $sample->sert_id = intval($id);

        if (Yii::$app->request->isPost) {

            if ($animal->load(Yii::$app->request->post())) {
                $num = Samples::find()->filterWhere(['like', 'kod', $model->sert_full])->max('samp_id');

                $code = $model->sert_full;

                $num = $num + 1;
                $code .= $num;
                $sample->kod = $code . '/' . $num;
                $sample->samp_id = $num;
                $animal->inn = "{$animal->inn}";

                if ($animal->save() and $sample->load(Yii::$app->request->post())) {
                    $sample->animal_id = $animal->id;
                    $sample->sert_id = intval($id);
                    if ($sample->save(false)) {
                        Yii::$app->session->setFlash('success', Yii::t('client', 'Namuna muvoffaqiyatli saqlandi'));
                        return $this->redirect(['view', 'id' => $id]);
                    } else {
                        Yii::$app->session->setFlash('error', 'Maydonlar to\'ldirimlagan');
                    }
                }
            }

        }

        return $this->render('add', [
            'model' => $model,
            'animal' => $animal,
            'sample' => $sample,
        ]);
    }

    protected
    function findModel($id)
    {
        if (($model = Sertificates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.sertificates', 'The requested page does not exist.'));
    }

    public
    function actionVaccination($id, $sert_id)
    {

        $model = new Vaccination();
        $model->animal_id = $id;
        $animal = Animals::findOne($id);
        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            return $this->redirect(['view', 'id' => $sert_id]);
        }
        return $this->render('vaccination', ['model' => $model, 'animal' => $animal]);
    }

    public
    function actionEmlash($id, $sert_id)
    {

        $model = new Emlash();
        $model->animal_id = $id;
        $animal = Animals::findOne($id);
        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            return $this->redirect(['view', 'id' => $sert_id]);
        }
        return $this->render('emlash', ['model' => $model, 'animal' => $animal]);

    }


    public
    function actionProduct()
    {
        $model = new FoodSamplingCertificate();
        $pro = new ProductExpertise();
        $model->pnfl = Yii::$app->session->get('doc_pnfl');
        if ($model->load(Yii::$app->request->post())) {

//            $org = $model->organization_id;
//
//            $num = FoodSamplingCertificate::find()->where(['organization_id'=>$org])->andFilterWhere(['like','food_id',date('Y')])->max('food_id');

//            $code = substr(date('Y'),2,2).'-2-'.get3num($org).'-';

//            $num = $num+1;
//            $code .= $num;
//            $model->kod = $code;
//            $model->food_id = $num;
//            $pro->orgaization_id = $model->organization_id;
            $num = FoodSamplingCertificate::find()->filterWhere(['like', 'sampling_date', date('Y')])->max('id');
            $vet = VetSites::findOne($model->sampling_site);
            $code = $vet->soato0->region_id . $vet->soato0->district_id . '-' . substr(date('Y'), 2, 2) . '-';

            $num = $num + 1;
            $code .= $num;
            $model->code = "$num";
//            var_dump($model->code) or die();
            $pro->pnfl = $model->pnfl;
            $pro->vet_site_id = $model->sampling_site;
            if ($model->save() and $pro->load(Yii::$app->request->post())) {
                $pro->food_sampling_certificate = $model->id;
                $pro->save();
                return $this->redirect(['viewfood', 'id' => $model->id]);
            }
        }
        return $this->render('product', ['model' => $model, 'pro' => $pro]);
    }

    public
    function actionViewfood($id)
    {
        $model = FoodSamplingCertificate::findOne($id);
        return $this->render('viewfood', [
            'model' => $model
        ]);
    }

    public function actionListfood(int $export = null)
    {
        $searchModel = new FoodSamplingCertificateSearch();
        $dataProvider = $searchModel->searchDistrict($this->request->queryParams);

        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdflistfood', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('listfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public
    function actionSertapp(int $export = null)
    {
        $searchModel = new SampleRegistrationSearch();
        $dataProvider = $searchModel->searchdistrict($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdflistsert', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('listsert', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public
    function actionViewsert($id)
    {
        $model = SampleRegistration::findOne($id);
        $samples = Samples::find()->select(['samples.*'])
            ->innerJoin('composite_samples', 'composite_samples.sample_id = samples.id')
            ->where(['composite_samples.registration_id' => $id])->all();

        return $this->render('viewsert', [
            'model' => $model,
            'samples' => $samples
        ]);
    }

    public function actionViewnamuna($id)
    {
        if ($this->request->isAjax) {
            return $this->renderAjax('viewnamuna', [
                'model' => Samples::find()->where(['id' => $id])->one(),
            ]);
        } else {
            return $this->render('viewnamuna', [
                'model' => Samples::find()->where(['id' => $id])->one()
            ]);
        }
    }

    public function actionReportanimal(int $export = null)
    {
        $searchModel = new ReportAnimalSearch();
        $dataProvider = $searchModel->searchSub($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfreportanimal', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('reportanimal', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Lists all ReportFood models.
     *
     * @return string
     */
    public function actionReportfood(int $export = null)
    {
        $searchModel = new ReportFoodSearch();
        $dataProvider = $searchModel->searchSub($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfreportfood', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('reportfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all ReportDrugs models.
     *
     * @return string
     */
    public function actionReportdrugs(int $export = null)
    {
        $searchModel = new ReportDrugsSearch();
        $dataProvider = $searchModel->searchSub($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfreportdrugs', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('reportdrugs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportanimalview($id)
    {
        $model = ReportAnimal::findOne(['id' => $id]);

        if($model->load(Yii::$app->request->post())){
            $model->organization_id = Yii::$app->user->identity->empPosts->org_id;
            $model->operator_id = Yii::$app->user->identity->id;
            if($model->save()){
                Yii::$app->session->setFlash('success','Ma\'lumot muvoffaqiyatli saqlandi');
            }
        }
        return $this->render('reportanimalview', [
            'model' => $model,
        ]);
    }

    public function actionReportfoodview($id)
    {
        return $this->render('reportfoodview', [
            'model' => ReportFood::findOne(['id' => $id]),
        ]);
    }

    public function actionReportdrugsview($id)
    {
        return $this->render('reportdrugsview', [
            'model' => ReportDrugs::findOne(['id' => $id]),
        ]);
    }

    public function actionStat($id = null)
    {
        $SoatoModel = new SoatoSearch();
        $SoatoDataProvider = $SoatoModel->ListRegions($id);

        $AnimalDataModel = new SertificatesSearch(); //Hayvon kasalliklari Dalolatnoma
        $AnimalDataProvider = $AnimalDataModel->searchregion($this->request->queryParams);
        $AnimalRegModel = new SampleRegistrationSearch(); //Hayvon Kasalliklari Ariza
        $AnimalRegProvider = $AnimalRegModel->searchregion($this->request->queryParams);
        $FoodDataModel = new FoodSamplingCertificateSearch(); //Oziq-ovqat ekspertizasi Dalolatnoma
        $FoodDataProvider = $FoodDataModel->search($this->request->queryParams);
        $FoodRegModel = new FoodRegistrationSearch(); //Oziq-ovqat arizalari
        $FoodRegProvider = $FoodRegModel->search($this->request->queryParams);
        return $this->render('stat', [
            'AnimalDataModel' => $AnimalDataModel,
            'AnimalDataProvider' => $AnimalDataProvider,
            'AnimalRegModel' => $AnimalRegModel,
            'AnimalRegProvider' => $AnimalRegProvider,
            'FoodDataModel' => $FoodDataModel,
            'FoodDataProvider' => $FoodDataProvider,
            'FoodRegModel' => $FoodRegModel,
            'FoodRegProvider' => $FoodRegProvider,
            'SoatoModel' => $SoatoModel,
            'SoatoDataProvider' => $SoatoDataProvider,
        ]);
    }

    public function actionStatRegfood($id = null)
    {
        $title="Oziq-ovqat ekspertizalari bo'yicha Arizalar statistikasi";
        $SoatoModel = new SoatoSearch();
        $SoatoDataProvider = $SoatoModel->ListRegions($id);
        $FoodRegModel = new FoodRegistrationSearch(); //Oziq-ovqat arizalari
        $FoodRegProvider = $FoodRegModel->search($this->request->queryParams);
        $status = ArrayHelper::map(SertStatus::find()->asArray()->all(), 'id', 'name_uz');
        $counter = array_fill(0, 14, array_fill(0, 7, 0));
        foreach ($SoatoDataProvider->getModels() as $key => $SoatoModel) {
            foreach ($FoodRegProvider->getModels() as $model) {
                if ($model->inn) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                } elseif ($model->pnfl) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                }
            }
        }
        return $this->render('stat-all', [
            'title'=>$title,
            'FoodRegProvider' => $FoodRegProvider,
            'SoatoDataProvider' => $SoatoDataProvider,
            'status' => $status,
            'counter' => $counter,

        ]);
    }

    public function actionStatAnimal($id = null)
    {
        $title="Hayvon kasalliklari bo'yicha Dalolatnomalar statistikasi";
        $SoatoModel = new SoatoSearch();
        $SoatoDataProvider = $SoatoModel->ListRegions($id);
        $AnimalDataModel = new SertificatesSearch(); //Hayvon kasalliklari Dalolatnoma
        $AnimalDataProvider = $AnimalDataModel->searchregion($this->request->queryParams);
        $status = ArrayHelper::map(SertStatus::find()->asArray()->all(), 'id', 'name_uz');
        $counter = array_fill(0, 14, array_fill(0, 7, 0));
        foreach ($SoatoDataProvider->getModels() as $key => $SoatoModel) {
            foreach ($AnimalDataProvider->getModels() as $model) {
                if ($model->inn) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                } elseif ($model->pnfl) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                }
            }
        }
        return $this->render('stat-all', [
            'title'=>$title,
            'SoatoDataProvider' => $SoatoDataProvider,
            'status' => $status,
            'counter' => $counter,

        ]);
    }

    public function actionStatFood($id = null)
    {
        $title="Oziq-ovqat ekspertizalari bo'yicha Dalolatnomalar statistikasi";
        $SoatoModel = new SoatoSearch();
        $SoatoDataProvider = $SoatoModel->ListRegions($id);
        $FoodDataModel = new FoodSamplingCertificateSearch(); //Oziq-ovqat ekspertizasi Dalolatnoma
        $FoodDataProvider = $FoodDataModel->search($this->request->queryParams);
        $status = ArrayHelper::map(SertStatus::find()->asArray()->all(), 'id', 'name_uz');
        $counter = array_fill(0, 14, array_fill(0, 7, 0));
        foreach ($SoatoDataProvider->getModels() as $key => $SoatoModel) {
            foreach ($FoodDataProvider->getModels() as $model) {
                if ($model->inn) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                } elseif ($model->pnfl) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                }
            }
        }
        return $this->render('stat-all', [
            'title'=>$title,
            'SoatoDataProvider' => $SoatoDataProvider,
            'status' => $status,
            'counter' => $counter,

        ]);
    }
    public function actionStatReganimal($id = null)
    {
        $title="Hayvon kasalliklari bo'yicha Arizalar statistikasi";
        $SoatoModel = new SoatoSearch();
        $SoatoDataProvider = $SoatoModel->ListRegions($id);
        $AnimalRegModel = new SampleRegistrationSearch(); //Hayvon Kasalliklari Ariza
        $AnimalRegProvider = $AnimalRegModel->searchregion($this->request->queryParams);
        $status = ArrayHelper::map(SertStatus::find()->asArray()->all(), 'id', 'name_uz');
        $counter = array_fill(0, 14, array_fill(0, 7, 0));
        foreach ($SoatoDataProvider->getModels() as $key => $SoatoModel) {
            foreach ($AnimalRegProvider->getModels() as $model) {
                if ($model->inn) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->inn0->soato->district_id == $SoatoModel->district_id) : ($model->inn0->soato->region_id == $SoatoModel->region_id);
                } elseif ($model->pnfl) {
                    $counter[$key][$model->status_id] += Yii::$app->request->get('id') ? ($model->pnfl0->soato->district_id == $SoatoModel->district_id) : ($model->pnfl0->soato->region_id == $SoatoModel->region_id);
                }
            }
        }
        return $this->render('stat-all', [
            'title'=>$title,
            'SoatoDataProvider' => $SoatoDataProvider,
            'status' => $status,
            'counter' => $counter,

        ]);
    }

    public function actionSertfood(int $export = null)
    {
        $searchModel = new FoodRegistrationSearch();
        $dataProvider = $searchModel->searchDistrict($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfsertfood', ['dataProvider' => $dataProvider]),
                'options' => [
                ],
                'methods' => [
                    'SetTitle' => $searchModel::tableName(),
                    'SetHeader' => [$searchModel::tableName() . '|| ' . date("r")],
                    'SetFooter' => ['| {PAGENO} |'],
                    'SetAuthor' => '@QalandarDev',
                    'SetCreator' => '@QalandarDev',
                ]
            ]);
            try {
                return $pdf->render();
            } catch (MpdfException $e) {
                return $e;
            } catch (CrossReferenceException $e) {
                return $e;
            } catch (PdfTypeException $e) {
                return $e;
            } catch (PdfParserException $e) {
                return $e;
            } catch (InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('sertfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSertfoodview($id)
    {
        $model = FoodRegistration::findOne($id);
        $samples = FoodSamples::find()->select(['food_samples.*'])
            ->innerJoin('food_compose', 'food_compose.sample_id = food_samples.id')
            ->where(['food_compose.registration_id' => $id])->all();
        return $this->render('sertfoodview', [
            'model' => $model,
            'samp' => $samples
        ]);
    }

    public function actionPdfdest($id)
    {
        $model = DestructionSampleAnimal::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();

    }

    public function actionPdfdestfood($id)
    {
        $model = DestructionSampleFood::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();

    }

    public function actionAnimalPdf($id)
    {
        $model = Samples::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }

    public function actionFoodPdf($id)
    {
        $model = FoodSamples::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }

}
