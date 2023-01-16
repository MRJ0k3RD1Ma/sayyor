<?php

namespace frontend\controllers;

use app\models\search\director\DestructionSampleAnimalSearch;
use app\models\search\registr\DestructionSampleFoodSearch;
use common\models\Animals;
use common\models\ComposeForm;
use common\models\CompositeSamples;
use common\models\DestructionSampleAnimal;
use common\models\DestructionSampleFood;
use common\models\DistrictView;
use common\models\Emlash;
use common\models\Employees;
use common\models\Food;
use common\models\FoodCompose;
use common\models\FoodRegistration;
use common\models\FoodRoute;
use common\models\FoodSamples;
use common\models\FoodSamplingCertificate;
use common\models\Individuals;
use common\models\LegalEntities;
use common\models\QfiView;
use common\models\ResultAnimal;
use common\models\ResultAnimalTests;
use common\models\ResultFood;
use common\models\ResultFoodTests;
use common\models\RouteSert;
use common\models\SampleRegistration;
use common\models\Samples;
use common\models\TamplateAnimal;
use common\models\TemplateFood;
use common\models\UnComposeForm;
use DateTime;
use frontend\components\Animal;
use frontend\components\General;
use frontend\models\search\registr\FoodRegistrationSearch;
use common\models\Sertificates;
use common\models\Vaccination;
use common\models\VetSites;
use frontend\models\search\lab\SertificatesRegSearch;
use frontend\models\search\lab\SertificatesSearch;
use frontend\models\search\registr\SampleRegistrationSearch;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class RegisterController extends Controller
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
                    'logout' => ['post'],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionIncometest($id)
    {
        $model = $this->findModel($id);
        $model->operator = Yii::$app->user->id;
        $model->status_id = 2;

        $model->save();
        return $this->redirect(['viewtest', 'id' => $model->id]);
    }

    protected function findModel($id)
    {
        if (($model = Sertificates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.sertificates', 'The requested page does not exist.'));
    }


    public function actionGetInd($pnfl, $doc)
    {
        if ($model = Individuals::find()->where(['pnfl' => $pnfl])->andWhere(['passport' => $doc])->one()) {
            $res = "{
                \"code\":200,
                \"value\":{\"pnfl\":\"{$pnfl}\",
                    \"name\":\"{$model->name}\",
                    \"surname\":\"{$model->surname}\",
                    \"middlename\":\"{$model->middlename}\",
                    \"region_id\":\"{$model->soato->region_id}\",
                    \"district_id\":\"{$model->soato->district_id}\",
                    \"soato_id\":\"{$model->soato_id}\",
                    \"passport\":\"{$model->passport}\",
                    \"adress\":\"{$model->adress}\"
                }
            }";
        } else {
            $res = get_web_page(Yii::$app->params['hamsa']['url']['getfizinfo'] . '?pinfl=' . $pnfl . '&document=' . $doc, 'hamsa');
            $model = new Individuals();
            $res = json_decode($res, true);
            if ($res['code']['result'] != 2200 or (isset($res['data']['result']) and $res['data']['result'] == 0)) {
                return -1;
            }

            $model->passport = $res['data']['inf']['document'];
            $model->surname = $res['data']['inf']['surname_latin'];
            $model->name = $res['data']['inf']['name_latin'];
            $model->middlename = $res['data']['inf']['patronym_latin'];
            $model->pnfl = $pnfl;
            $res = "{
                \"code\":200,
                \"value\":{\"pnfl\":\"{$pnfl}\",
                    \"name\":\"{$model->name}\",
                    \"surname\":\"{$model->surname}\",
                    \"middlename\":\"{$model->middlename}\",
                    \"region_id\":\"-1\",
                    \"district_id\":\"-1\",
                    \"soato_id\":\"-1\",
                    \"passport\":\"{$model->passport}\",
                    \"adress\":\"{$model->adress}\"
                }
            }";
        }
        echo $res;
        exit;
    }


    public function actionGetDistrict($id)
    {
        $model = DistrictView::find()->where(['region_id' => $id])->all();
        $text = Yii::t('cp.vetsites', '- Tumanni tanlang -');
        $res = "<option value=''>{$text}</option>";
        $lang = Yii::$app->language;
        foreach ($model as $item) {
            if ($lang == 'ru') {
                $name = $item->name_ru;
            } elseif ($lang == 'oz') {
                $name = $item->name_cyr;
            } else {
                $name = $item->name_lot;
            }
            $res .= "<option value='{$item->district_id}'>{$name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionGetQfi($id, $regid)
    {
        $model = QfiView::find()->where(['district_id' => $id])->andWhere(['region_id' => $regid])->all();
        $text = Yii::t('cp.vetsites', '- QFYni tanlang -');
        $res = "<option value=''>{$text}</option>";
        $lang = Yii::$app->language;
        foreach ($model as $item) {
            if ($lang == 'ru') {
                $name = $item->name_ru;
            } elseif ($lang == 'oz') {
                $name = $item->name_cyr;
            } else {
                $name = $item->name_lot;
            }
            $res .= "<option value='{$item->MHOBT_cod}'>{$name}</option>";
        }
        echo $res;
        exit;
    }

    public function actionGetinn($inn)
    {
        if ($model = LegalEntities::findOne(['inn' => $inn])) {
            $res = "{
                \"code\":200,
                \"value\":{\"inn\":\"{$inn}\",
                    \"name\":\"{$model->name}\",
                    \"region\":\"{$model->soato->region_id}\",
                    \"district\":\"{$model->soato->district_id}\",
                    \"soato_id\":\"{$model->soato_id}\",
                    \"tshx_id\":\"{$model->tshx_id}\",
                    \"soogu\":\"{$model->soogu}\"
                }
            }";
            return $res;
        } else {
            return -1;
        }
    }

    public function actionGetvetsites($id)
    {
        $model = VetSites::find()->where(['soato' => $id])->all();
        $text = Yii::t('cp.vetsites', '- Vet uchstkani tanlang -');
        $res = "<option value=''>{$text}</option>";
        foreach ($model as $item) {

            $res .= "<option value='{$item->id}'>{$item->name}</option>";
        }
        echo $res;
        exit;
    }


    public function actionRegtest(int $export = null)
    {
        $searchModel = new SampleRegistrationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfregtest', ['dataProvider' => $dataProvider]),
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



        return $this->render('regtest', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIncome($id)
    {
        $model = SampleRegistration::findOne($id);
        $model->emp_id = Yii::$app->user->id;
        $cs = CompositeSamples::find()->where(['registration_id' => $id])->all();
        foreach ($cs as $item) {
            $samp = Samples::findOne($item->sample_id);
            $samp->status_id = 2;
            $samp->save();
            $samp = null;
        }
        $samp = Samples::findOne($cs[0]->sample_id);
        $sert = Sertificates::findOne($samp->sert_id);
        $sert->status_id = 2;
        $model->status_id = 2;
        $sert->save();
        $model->save();
        return $this->redirect(['regview', 'id' => $id]);
    }


    public function actionRegview($id)
    {
        $model = SampleRegistration::findOne($id);
        $samples = Samples::find()->select(['samples.*'])
            ->innerJoin('composite_samples', 'composite_samples.sample_id = samples.id')
            ->where(['composite_samples.registration_id' => $id])->andWhere(['samples.is_group'=>0])->all();

        $samples_comp = Samples::find()->select(['samples.*'])
            ->innerJoin('composite_samples', 'composite_samples.sample_id = samples.id')
            ->where(['composite_samples.registration_id' => $id])->andWhere(['samples.is_group'=>1])->all();
        $compose = new ComposeForm();
        $uncompose = new UnComposeForm();
        if(Yii::$app->request->isPost){
            if($compose->load(Yii::$app->request->post())){
                $group = [
                    'not'=>0,
                    'yes'=>0,
                    'cnt'=>0
                ];
                foreach ($compose->id as $key=>$item){

                    if($item==1){
                        $group['cnt']++;
                        if($cmodel = Samples::findOne($key)){
                            $reg_id = CompositeSamples::findOne(['sample_id'=>$key])->registration_id;
                            if($sample = Samples::find()->where('id in (select sample_id from composite_samples where sample_id <> '.$key.' and registration_id = '.$reg_id.')')
                                ->andWhere(['is_group'=>1])->one()){
                                if($cmodel->suspected_disease_id == $sample->suspected_disease_id){
                                    $cmodel->is_group = 1;
                                    $cmodel->save(false);
                                    $group['yes']++;
                                }else{
                                    $group['not']++;
                                }
                            }else{
                                $cmodel->is_group = 1;
                                $cmodel->save(false);
                                $group['yes']++;
                            }
                        }
                    }
                }
                $text = "Birlashtirilishi kerak bo`lgan ".$group['cnt']." ta namunadan ";
                if($group['yes']>0){
                    $text.=$group['yes'].' ta namuna birlashtirildi.';
                }
                if($group['not']>0){
                    $text.=$group['not'].' ta namuna paramertlari to`g`ri kelmaganligi sababli birlashtirilmadi';
                }
                Yii::$app->session->setFlash('success',$text);
                return $this->refresh();
            }
        }
        if(Yii::$app->request->isPost){
            if($uncompose->load(Yii::$app->request->post())){
                $group = [
                    'yes'=>0,
                    'cnt'=>0
                ];
                foreach ($uncompose->id as $key=>$item){
                    $group['cnt']++;

                    if($item == 1){
                        $group['yes']++;

                        $sam = Samples::findOne($key);
                        $sam->is_group = 0;
                        $sam->save(false);
                    }
                }
                $text = $group['cnt']." ta namunadan ";
                if($group['yes']>0){
                    $text.=$group['yes'].' ta namuna alohida qilindi.';
                }

                Yii::$app->session->setFlash('success',$text);
                return $this->refresh();
            }
        }
        return $this->render('regview', [
            'model' => $model,
            'samples' => $samples,
            'samples_comp' => $samples_comp,
            'compose'=>$compose,
            'uncompose'=>$uncompose
        ]);
    }


    public function actionSend($id)
    {
        $model = Samples::findOne($id);
        return $this->renderAjax('send', [
            'model' => $model
        ]);
    }

    public function actionViewtestreg($id)
    {
        $model = Sertificates::findOne($id);

        return $this->render('viewtestreg', [
            'model' => $model
        ]);
    }

    public function actionRegproduct(int $export = null)
    {
        $searchModel = new FoodRegistrationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            return $searchModel->exportToExcel($dataProvider->query);
        } else if ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfregproduct', ['dataProvider' => $dataProvider]),
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
        return $this->render('regproduct', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegproductview($id)
    {
        $model = FoodRegistration::findOne($id);
        $samples = FoodSamples::find()->select(['food_samples.*'])
            ->innerJoin('food_compose', 'food_compose.sample_id = food_samples.id')
            ->where(['food_compose.registration_id' => $id])->andWhere(['is_group'=>0])->all();
        $unsamp = FoodSamples::find()->select(['food_samples.*'])
            ->innerJoin('food_compose', 'food_compose.sample_id = food_samples.id')
            ->where(['food_compose.registration_id' => $id])->andWhere(['is_group'=>1])->all();
        $compose = new ComposeForm();
        if($compose->load(Yii::$app->request->post())){

            $group = [
                'not'=>0,
                'yes'=>0,
                'cnt'=>0
            ];
            foreach ($compose->id as $key=>$item){
                if($item==1){
                    $group['cnt']++;
                    if($cmodel = FoodSamples::findOne($key)){
                        $reg_id = FoodCompose::findOne(['sample_id'=>$key])->registration_id;
                        if($sample = FoodSamples::find()->where('id in (select sample_id from food_compose where sample_id <> '.$key.' and registration_id = '.$reg_id.')')
                            ->andWhere(['is_group'=>1])->one()){
                            if($cmodel->category_id == $sample->category_id){
                                if(true or $cmodel->food->for_all == 1 or $sample->food->for_all == 1 or $cmodel->food_id == $sample->food_id){
                                    $cmodel->is_group = 1;
                                    $cmodel->save(false);
                                    $group['yes']++;
                                }else{
                                    $group['not']++;
                                }
                            }else{
                                $group['not']++;
                            }
                        }else{
                            $cmodel->is_group = 1;
                            $cmodel->save(false);
                            $group['yes']++;
                        }
                    }
                }
            }
            $text = "Birlashtirilishi kerak bo`lgan ".$group['cnt']." ta namunadan ";
            if($group['yes']>0){
                $text.=$group['yes'].' ta namuna birlashtirildi.';
            }
            if($group['not']>0){
                $text.=$group['not'].' ta namuna paramertlari to`g`ri kelmaganligi sababli birlashtirilmadi';
            }
            $color = 'success';
            if($group['cnt'] == $group['not']){
                $color = 'error';
            }
            Yii::$app->session->setFlash($color,$text);
            return $this->refresh();
        }


        $uncompose = new UnComposeForm();
        if(Yii::$app->request->isPost){
            if($uncompose->load(Yii::$app->request->post())){
                $group = [
                    'yes'=>0,
                    'cnt'=>0
                ];
                foreach ($uncompose->id as $key=>$item){
                    $group['cnt']++;

                    if($item == 1){
                        $group['yes']++;

                        $sam = FoodSamples::findOne($key);
                        $sam->is_group = 0;
                        $sam->save(false);
                    }
                }
                $text = $group['cnt']." ta namunadan ";
                if($group['yes']>0){
                    $text.=$group['yes'].' ta namuna alohida qilindi.';
                }

                Yii::$app->session->setFlash('success',$text);
                return $this->refresh();
            }
        }

        return $this->render('regproductview', [
            'model' => $model,
            'samp' => $samples,
            'unsamp'=>$unsamp,
            'compose'=>$compose,
            'uncompose'=>$uncompose
        ]);
    }


    public function actionIncomesamples($id, $regid,$route_id=null)
    {
        $reg = SampleRegistration::findOne($regid);
        $model = Samples::findOne($id);
        if($director_id = \common\models\RouteSert::find()->where(['registration_id'=>$reg->id])->one()){
            $director_id = $director_id->director_id;
        }else{
            $director_id = -1;
        }

        $res = ResultAnimal::findOne(['sample_id'=>$model->id]);
        if($res){
            $template = TamplateAnimal::find()
                ->where(['diseases_id'=>$model->suspected_disease_id])
                ->andWhere('`id` in (select `template_id` from `template_animal_types` where `type_id` = '.$model->animal->type_id.')')
                ->andWhere('`id` in (select `template_id` from `template_samples` where `type_id` = '.$model->sample_type_is.')')
                ->andWhere('`id` not in (select template_id from result_animal_tests where result_id = '.$res->id.')')
                ->all();
        }else{
            $template = TamplateAnimal::find()
                ->where(['diseases_id'=>$model->suspected_disease_id])
                ->andWhere('`id` in (select `template_id` from `template_animal_types` where `type_id` = '.$model->animal->type_id.')')
                ->andWhere('`id` in (select `template_id` from `template_samples` where `type_id` = '.$model->sample_type_is.')')
                ->all();
        }

        if($r = RouteSert::findOne($route_id)){
            $route = $r;
            $result = $res;
            if($route->load(Yii::$app->request->post())){
                if($route->temp){
                    foreach ($route->temp as $key=>$i) {
                        if($i == 1){
                            $item = TamplateAnimal::findOne($key);
                            $test = new ResultAnimalTests();
                            $test->checked = 1;
                            $test->result_id = $result->id;
                            $test->template_id = $item->id;
                            $test->type_id = $model->animal->type_id;
                            $test->ch_min1 = $item->min;
                            $test->ch_min2 = $item->min_1;
                            $test->ch_max1 = $item->max;
                            $test->route_id = $route->id;
                            $test->ch_max2 = $item->max_1;
                            $test->result = '';
                            $test->result_2 = '';
                            $test->change_unit_id = $item->unit_id;
                            $test->save();
                            $test = null;
                        }
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('test', 'Namunaga shablonlar muvoffaqiyatli yuborildi'));
                return $this->redirect(['/register/regview', 'id' => $regid]);
            }
        }else{
            $route = new RouteSert();
            $route->vet4 = $model->suspectedDisease->vet4 . $model->animal->type->vet4 . $model->sampleTypeIs->vet4;
            if($director_id != -1){
                $route->director_id = $director_id;
            }

        }
        if ($reg->status_id < 2) {
            Animal::income($reg,$regid);
        }

        $cs = CompositeSamples::findOne(['registration_id' => $regid, 'sample_id' => $id]);

        if (Yii::$app->request->isPost) {

            if ($cs->load(Yii::$app->request->post()) and $route->load(Yii::$app->request->post())) {

                if ($cs->sample_status_id == 2) {
                    Animal::denySample($model,$cs,$route,$reg);
                    return $this->redirect(['/register/regview', 'id' => $regid]);
                }
                // manimcha ishlidi
                if($route->isNewRecord and RouteSert::find()->where(['sample_id'=>$model->id,'leader_id'=>$route->leader_id])->one()){
                    $route = RouteSert::find()->where(['sample_id'=>$model->id,'leader_id'=>$route->leader_id])->one();
                }
                $route->status_id = 1;
                $model->status_id = 3;
                $route->sample_id = $id;
                $dal = Sertificates::findOne($model->sert_id);
                $dal->status_id = 3;
                $dal->save();
                $reg->status_id = 3;
                $reg->save();
                $model->emp_id = Yii::$app->user->id;
                $route->registration_id = $regid;
                $route->vet4 = $model->suspectedDisease->vet4 . $model->animal->type->vet4 . $model->sampleTypeIs->vet4;
                $route->sample_type_id = $model->sample_type_is;
                $model->save();
                $cs->save();

                $route->save();

                $result = new ResultAnimal();
                if($res){
                    $result = $res;
                }
                $result->org_id = Yii::$app->user->identity->empPosts->org_id;
                $num = ResultAnimal::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
                $num = intval($num) + 1;
                $result->code = General::get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
                $result->code_id = $num;

                $result->sample_id = $cs->sample_id;
                $result->state_id = 1;
                $result->save();


                if($route->temp){
                    foreach ($route->temp as $key=>$i) {
                        if($i == 1){
                            $item = TamplateAnimal::findOne($key);
                            $test = new ResultAnimalTests();
                            $test->checked = 1;
                            $test->route_id = $route->id;
                            $test->result_id = $result->id;
                            $test->template_id = $item->id;
                            $test->type_id = $model->animal->type_id;
                            $test->ch_min1 = $item->min;
                            $test->ch_min2 = $item->min_1;
                            $test->ch_max1 = $item->max;
                            $test->ch_max2 = $item->max_1;
                            $test->result = '';
                            $test->result_2 = '';
                            $test->change_unit_id = $item->unit_id;
                            $test->save();
                            $test = null;
                        }
                    }
                }

                Yii::$app->session->setFlash('success', Yii::t('test', 'Namuna muvoffaqiyatli yuborildi'));
                return $this->redirect(['/register/regview', 'id' => $regid]);
            }
        }

        $org_id = Yii::$app->user->identity->empPosts->org_id;

        $directos = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 4])
            ->andWhere(['emp_posts.org_id' => $org_id])
            ->all();

        $lider = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 3])
            ->andWhere(['emp_posts.org_id' => $org_id])
            ->andWhere('employees.id not in (select leader_id from route_sert where sample_id='.$model->id.')')
            ->all();
        $lider_all = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 3])
            ->andWhere(['emp_posts.org_id' => $org_id])
            ->all();
        return $this->render('incomesamples', [
            'model' => $model,
            'reg' => $reg,
            'cs' => $cs,
            'route' => $route,
            'director' => $directos,
            'lider' => $lider,
            'template'=>$template,
            'lider_all'=>$lider_all,
            'result'=>$res,
            'route_id'=>$route_id,
            'director_id'=>$director_id
        ]);
    }


    public function actionIncomeanimalmulti($id,$leader_id = null){
        $reg = SampleRegistration::findOne($id);
        if($director_id = \common\models\RouteSert::find()->where(['registration_id'=>$reg->id])->one()){
            $director_id = $director_id->director_id;
        }else{
            $director_id = -1;
        }
        if($samples = Samples::find()
            ->where('id in (select sample_id from composite_samples where registration_id = '.$id.' and (sample_status_id=1 or sample_status_id is null))')
            ->andWhere(['is_group'=>1])->all()){
            $model = $samples[0];
            $result = ResultAnimal::findOne(['sample_id'=>$model->id]);
            $cs = CompositeSamples::find()->select(['composite_samples.*'])
                ->innerJoin('samples','composite_samples.sample_id = samples.id')
                ->where(['composite_samples.registration_id'=>$reg->id,'samples.is_group'=>1])->andWhere('composite_samples.sample_status_id = 1 or composite_samples.sample_status_id is null')->all();
            if($result){
                $template = TamplateAnimal::find()
                    ->where(['diseases_id'=>$model->suspected_disease_id])
                    ->andWhere('`id` in (select `template_id` from `template_samples` where `type_id` = '.$model->sample_type_is.')')
                    ->andWhere('`id` not in (select template_id from result_animal_tests where result_id = '.$result->id.')')
                    ->all();
            }else{
                $template = TamplateAnimal::find()
                    ->where(['diseases_id'=>$model->suspected_disease_id])
                    ->andWhere('`id` in (select `template_id` from `template_samples` where `type_id` = '.$model->sample_type_is.')')
                    ->all();
            }

            if($r = RouteSert::find()->where(['registration_id'=>$reg->id,'leader_id'=>$leader_id,'is_group'=>1])->one()){
                $route = $r;

            }else{
                $route = new RouteSert();
                $route->vet4 = $model->suspectedDisease->vet4 . $model->animal->type->vet4 . $model->sampleTypeIs->vet4;
            }
            if($director_id != -1){
                $route->director_id = $director_id;
            }
            if(Yii::$app->request->isPost){

                if($req = Yii::$app->request->post()){

                   if($route->isNewRecord) {
                       $num = SampleRegistration::find()->where(['organization_id' => Yii::$app->user->identity->empPosts->org_id])->max('res_id');
                       $nm = intval($num)+1;
                       $reg->res = "M/".General::get3num($reg->organization_id).'-'.$nm;
                       $reg->res_id = $nm;
                       $reg->save(false);
                       $reg->save();
                        $asdasd = 0;
                       foreach ($req['CompositeSamples'] as $key => $item) {
                           if ($com = CompositeSamples::findOne(['sample_id'=>$key])) {
                                $asdasd ++;
                               if ($item['sample_status_id'] == 1) {
                                   $com->sample_status_id = 1;
                                   $com->ads = $item['ads'];
                                   $com->save(false);
                                   $r = $req['RouteSert'];
                                   $rt = new RouteSert();
                                   if ($rtt = RouteSert::find()->where(['registration_id'=>$reg->id,'leader_id'=>$leader_id, 'is_group' => 1])->one()) {
                                       $rt = $rtt;
                                   }
                                   if($director_id != -1){
                                       $rt->director_id = $director_id;
                                   }else{
                                       $rt->director_id = $r['director_id'];
                                   }
                                   $rt->leader_id = $r['leader_id'];
                                   $rt->state_id = 1;
                                   $rt->sample_id = $com->sample_id;
                                   $rt->registration_id = $com->registration_id;
                                   $rt->status_id = 1;
                                   $rt->is_group = 1;
                                   $rt->sample_type_id = $com->sample->sample_type_is;
                                   $rt->save();

                                   $samp = Samples::findOne($com->sample_id);
                                   $samp->status_id = 3;
                                   $dal = Sertificates::findOne($samp->sert_id);
                                   $dal->status_id = 3;
                                   $dal->save();
                                   $reg->status_id = 3;
                                   $reg->save();
                                   $samp->save();
                                   $rst = new ResultAnimal();
                                   if ($r = ResultAnimal::findOne(['sample_id' => $samp->id])) {
                                       $rst = $r;
                                   }

                                   $rst->org_id = Yii::$app->user->identity->empPosts->org_id;
                                   $rst->sample_id = $com->sample_id;
                                   $rst->state_id = 1;
                                   $rst->save();

                                   if ($req['RouteSert']['temp']) {
                                       foreach ($req['RouteSert']['temp'] as $k => $i) {
                                           if ($i == 1) {
                                               $tmpe = TamplateAnimal::findOne($k);
                                               $test = new ResultAnimalTests();
                                               $test->checked = 1;
                                               $test->result_id = $rst->id;
                                               $test->template_id = $tmpe->id;
                                               $test->type_id = $tmpe->unit->type_id;
                                               $test->ch_min1 = $tmpe->min;
                                               $test->ch_min2 = $tmpe->min_1;
                                               $test->ch_max1 = $tmpe->max;
                                               $test->ch_max2 = $tmpe->max_1;
                                               $test->route_id = $rt->id;
                                               $test->result = '';
                                               $test->result_2 = '';
                                               $test->change_unit_id = $tmpe->unit_id;
                                               $test->save();
                                               $test = null;
                                           }
                                       }
                                   }

                               }else{
                                   $com->sample_status_id = 2;
                                   $com->ads = $item['ads'];
                                   $com->save(false);
                                   $com->save();
                                   $samp = Samples::findOne($com->sample_id);
                                   $samp->status_id = 6;
                                   $samp->save();
                                   // namunani yo'q qilish
                                   $des = new DestructionSampleAnimal();
                                   $des->sample_id = $com->sample_id;
                                   $des->creator_id = Yii::$app->user->id;
                                   $num = DestructionSampleAnimal::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
                                   $num = (int)$num + 1;
                                   $des->code = General::get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
                                   $des->destruction_date = date('Y-m-d h:i:s');
                                   $des->state_id = 2;
                                   $des->ads = $com->ads;
                                   $des->consent_id = $req['RouteSert']['director_id'];;
                                   $des->org_id = Yii::$app->user->identity->empPosts->org_id;
                                   $des->save();

                                   $cnt = CompositeSamples::find()->where(['registration_id'=>$id])->count('sample_id');
                                   if($cnt == CompositeSamples::find()->where(['registration_id'=>$id])->andWhere(['sample_status_id'=>2])->count('sample_id')){
                                       $dal = Sertificates::findOne($samp->sert_id);
                                       $dal->status_id = 6;
                                       $dal->save();
                                       $reg->status_id = 6;
                                       $reg->save();
                                   }
                               }
                           }
                       }
                       Yii::$app->session->setFlash('success', 'Namunalar muvoffaqiyatli qabul qilindi va labaratoriyaga jo`natildi');
                       return $this->redirect(['regview', 'id' => $id]);
                   }else{

                       foreach ($cs as $key => $item) {
                           if ($com = CompositeSamples::findOne(['sample_id'=>$item->sample_id])) {
                                   $rt = new RouteSert();
                                   if ($rtt = RouteSert::find()->where(['registration_id'=>$reg->id,'leader_id'=>$leader_id, 'is_group' => 1])->one()) {
                                       $rt = $rtt;
                                   }
                                   $rt->director_id = $route->director_id;
                                   $rt->leader_id = $route->leader_id;
                                   $rt->state_id = 1;
                                   $rt->sample_id = $com->sample_id;
                                   $rt->registration_id = $com->registration_id;
                                   $rt->status_id = 1;
                                   $rt->is_group = 1;
                                   $rt->sample_type_id = $com->sample->sample_type_is;
                                   $rt->save();

                                   $samp = Samples::findOne($com->sample_id);
                                   $samp->status_id = 3;
                                   $dal = Sertificates::findOne($samp->sert_id);
                                   $dal->status_id = 3;
                                   $dal->save();
                                   $reg->status_id = 3;
                                   $reg->save();
                                   $samp->save();
                                   $rst = new ResultAnimal();
                                   if ($r = ResultAnimal::findOne(['sample_id' => $samp->id])) {
                                       $rst = $r;
                                   }

                                   $rst->org_id = Yii::$app->user->identity->empPosts->org_id;
                                   $rst->sample_id = $com->sample_id;
                                   $rst->state_id = 1;
                                   $rst->save();

                                   if ($req['RouteSert']['temp']) {
                                       foreach ($req['RouteSert']['temp'] as $k => $i) {
                                           if ($i == 1) {
                                               $tmpe = TamplateAnimal::findOne($k);
                                               $test = new ResultAnimalTests();
                                               $test->checked = 1;
                                               $test->result_id = $rst->id;
                                               $test->route_id = $route->id;
                                               $test->template_id = $i;
                                               $test->type_id = $tmpe->unit->type_id;
                                               $test->ch_min1 = $tmpe->min;
                                               $test->ch_min2 = $tmpe->min_1;
                                               $test->ch_max1 = $tmpe->max;
                                               $test->ch_max2 = $tmpe->max_1;
                                               $test->result = '';
                                               $test->result_2 = '';
                                               $test->change_unit_id = $tmpe->unit_id;
                                               $test->save();
                                               $test = null;
                                           }
                                       }
                                   }

                           }
                       }
                       Yii::$app->session->setFlash('success', 'Namunalarga qo`shimcha shablonlar biriktirildi');
                       return $this->redirect(['regview', 'id' => $id]);
                   }
                }

            }

            $org_id = Yii::$app->user->identity->empPosts->org_id;

            $directos = Employees::find()->select(['employees.*'])->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')->where(['emp_posts.post_id' => 4])->andWhere(['emp_posts.org_id' => $org_id])->all();
            $lider = Employees::find()->select(['employees.*'])
                ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
                ->where(['emp_posts.post_id' => 3])
                ->andWhere(['emp_posts.org_id' => $org_id])
                ->andWhere('employees.id not in (select leader_id from route_sert where registration_id='.$reg->id.' and is_group=1)')
                ->all();
            $lider_all = Employees::find()->select(['employees.*'])
                ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
                ->where(['emp_posts.post_id' => 3])
                ->andWhere(['emp_posts.org_id' => $org_id])
                ->all();
            return $this->render('incomeanimalmulti',[
                'model'=>$model,
                'samples'=>$samples,
                'reg'=>$reg,
                'template'=>$template,
                'result'=>$result,
                'route'=>$route,
                'lider_all'=>$lider_all,
                'cs'=>$cs,
                'director' => $directos,
                'lider' => $lider,
                'director_id'=>$director_id,
                'leader_id'=>$leader_id
            ]);



        }else{
            Yii::$app->session->setFlash('error','Namunalar mavjud emas');
            return $this->redirect(['/register/regview','id'=>$id]);
        }


    }

    public function actionIncomeproduct($id)
    {
        // income qilish yoziladi food_samplesni

        $model = FoodRegistration::findOne($id);
        $model->emp_id = Yii::$app->user->id;
        $cs = FoodCompose::find()->where(['registration_id' => $id])->all();
        foreach ($cs as $item) {
            $samp = FoodSamples::findOne($item->sample_id);
            $samp->status_id = 2;
            $samp->save();
            $samp = null;
        }
        $samp = FoodSamples::findOne($cs[0]->sample_id);
        $sert = FoodSamplingCertificate::findOne($samp->sert_id);
        $sert->status_id = 2;
        $model->status_id = 2;
        $sert->save();
        $model->save();
        return $this->redirect(['regproductview', 'id' => $id]);

    }

    public function actionIncomefood($id, $regid)
    {
        $reg = FoodRegistration::findOne($regid);
        $model = FoodSamples::findOne($id);
        $route = new FoodRoute();
        if($r = FoodRoute::findOne(['sample_id'=>$id])){
            $route = $r;
        }
        $res = ResultFood::findOne(['sample_id'=>$model->id]);
        if ($reg->status_id < 2) {
            $reg->emp_id = Yii::$app->user->id;
            $cs = FoodCompose::find()->where(['registration_id' => $regid])->all();
            foreach ($cs as $item) {
                $samp = FoodSamples::findOne($item->sample_id);
                $samp->status_id = 2;
                $samp->save();
                $samp = null;
            }
            $samp = FoodSamples::findOne($cs[0]->sample_id);
            $sert = FoodSamplingCertificate::findOne($samp->sert_id);
            $sert->status_id = 2;
            $reg->status_id = 2;
            $sert->save();
            $reg->save();
        }
        $cs = FoodCompose::findOne(['registration_id' => $regid, 'sample_id' => $id]);

        $template = TemplateFood::find()
            ->where(['category_id' => $cs->sample->category_id])
            ->andWhere('food_id in (select id from food where id='.$cs->sample->food_id.' or (for_all=1 and category_id='.$cs->sample->category_id.'))')
            ->andWhere($res?'id not in (select template_id from result_food_tests where result_id = '.$res->id.')':'1')
            ->all();

        if (Yii::$app->request->isPost) {
            if($cs->load(Yii::$app->request->post())){
                if ($cs->status_id == 2) {
                    $model->status_id = 6;

                    $dal = FoodSamplingCertificate::findOne($model->sert_id);
                    $dal->status_id = 6;
                    $dal->save();
                    $des = new DestructionSampleFood();
                    $des->sample_id = $cs->sample_id;
                    $des->creator_id = Yii::$app->user->id;
                    $num = DestructionSampleFood::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
                    $num = intval($num) + 1;
                    $des->code = General::get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
                    $des->code_id = $num;
                    $des->destruction_date = date('Y-m-d h:i:s');
                    $des->state_id = 2;
                    $des->ads = $cs->ads;

                    $des->org_id = Yii::$app->user->identity->empPosts->org_id;

                    $des->consent_id = $route->director_id;
                    $des->save();
                    $model->save();
                    $cs->save();
                    if(FoodCompose::find()->where(['status_id'=>2])->andWhere(['registration_id'=>$reg->id])->count('registration_id') ==
                        FoodCompose::find()->where(['registration_id'=>$reg->id])->count('registration_id')){
                        $reg->status_id = 6;
                    }
                    $reg->save();
                    return $this->redirect(['/register/regproductview', 'id' => $regid]);
                }
            }
            if ($route->load(Yii::$app->request->post())) {

                $route->status_id = 1;
                $model->status_id = 3;
                $route->sample_id = $id;
                $reg->status_id = 3;
                $dal = FoodSamplingCertificate::findOne($model->sert_id);
                $dal->status_id = 3;
                $dal->save();
                $reg->save();
                $model->emp_id = Yii::$app->user->id;
                $route->registration_id = $regid;
                $model->save();
                $cs->save();
                $route->save();


                if($r = ResultFood::findOne(['sample_id'=>$model->id])){
                    $result = $r;
                }else{
                    $result = new ResultFood();
                    $num = ResultFood::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
                    $num = intval($num) + 1;
                    $result->code = General::get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
                    $result->code_id = $num;
                    $result->org_id = Yii::$app->user->identity->empPosts->org_id;

                    $result->sample_id = $cs->sample_id;
                    $result->state_id = 1;
                    $result->creator_id = $route->executor_id;
                    $result->save();
                }

                foreach ($route->temp as $key=>$item) {
                    if($item == 1){
                        $test = new ResultFoodTests();
                        $test->result_id = $result->id;
                        $test->template_id = $key;
                        $tmp = TemplateFood::findOne($key);
                        $test->change_unit_id = $tmp->unit_id;
                        $test->ch_min1 = "{$tmp->min_1}";
                        $test->ch_min2 = "{$tmp->min_2}";
                        $test->ch_max1 = "{$tmp->max_1}";
                        $test->ch_max2 = "{$tmp->max_2}";
                        $test->result = '';
                        $test->result_2 = '';
                        $test->type_id = $tmp->unit->type_id;
                        $test->checked = 1;
                        $test->save();
                        $test = null;
                    }
                }

                Yii::$app->session->setFlash('success', Yii::t('test', 'Namuna {number} raqami bilan saqlandi', ['number' => $result->code]));
                return $this->redirect(['/register/regproductview', 'id' => $regid]);
            }
        }

        $org_id = Yii::$app->user->identity->empPosts->org_id;

        $directos = Employees::find()->select(['employees.*'])->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')->where(['emp_posts.post_id' => 4])->andWhere(['emp_posts.org_id' => $org_id])->all();
        $lider = Employees::find()->select(['employees.*'])->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')->where(['emp_posts.post_id' => 3])->andWhere(['emp_posts.org_id' => $org_id])->all();

        return $this->render('incomefood', [
            'model' => $model,
            'reg' => $reg,
            'cs' => $cs,
            'route' => $route,
            'director' => $directos,
            'lider' => $lider,
            'template'=>$template,
            'result'=>$res
        ]);


    }

    public function actionIncomeproductmulti($id){
        $reg = FoodRegistration::findOne($id);
        if($samples = FoodSamples::find()
        ->where('id in (select sample_id from food_compose where registration_id = '.$id.' and (status_id=1 or status_id is null))')
        ->andWhere(['is_group'=>1])->all()){
            $model = $samples[0];
            $result = ResultFood::findOne(['sample_id'=>$model->id]);
            $cs = FoodCompose::find()->select(['food_compose.*'])
                ->innerJoin('food_samples','food_compose.sample_id = food_samples.id')
                ->where(['food_compose.registration_id'=>$reg->id,'food_samples.is_group'=>1])
                ->andWhere('food_compose.status_id = 1 or food_compose.status_id is null')->all();
            if($result){

                $template = TemplateFood::find()
                    ->where(['category_id' => $model->category_id])
                    ->andWhere('food_id in (select id from food where id='.
                        $model->food_id.' or (for_all=1 and category_id='.$model->category_id.'))')
                    ->andWhere('id not in (select template_id from result_food_tests where result_id = '.$result->id.')')
                    ->all();

            }else{
                $template = TemplateFood::find()
                    ->where(['category_id' => $model->category_id])
                    ->andWhere('food_id in (select id from food where id='.
                        $model->food_id.' or (for_all=1 and category_id='.$model->category_id.'))')
                    ->all();
            }

            if($r = FoodRoute::find()->where(['registration_id'=>$id,'sample_id'=>$model->id,'is_group'=>1])->one()){
                $route = $r;
            }else{
                $route = new FoodRoute();
            }

            if(Yii::$app->request->isPost){

                if($req = Yii::$app->request->post()){

                    if($route->isNewRecord) {
                        $num = FoodRegistration::find()->where(['organization_id' => Yii::$app->user->identity->empPosts->org_id])->max('res_id');
                        $nm = intval($num)+1;
                        $reg->res = "M/".General::get3num($reg->organization_id).'-'.$nm;
                        $reg->res_id = $nm;
                        $reg->save(false);
                        $reg->save();

                        foreach ($req['FoodCompose'] as $key => $item) {
                            if ($com = FoodCompose::findOne(['sample_id'=>$key])) {

                                if ($item['status_id'] == 1) {
                                    $com->status_id = 1;
                                    $com->ads = $item['ads'];
                                    $com->save(false);
                                    $r = $req['FoodRoute'];
                                    $rt = new FoodRoute();
                                    if ($rtt = FoodRoute::find()->where(['registration_id' => $id, 'sample_id' => $com->sample_id, 'is_group' => 1])->one()) {
                                        $rt = $rtt;
                                    }
                                    $rt->director_id = $r['director_id'];
                                    $rt->leader_id = $r['leader_id'];
                                    $rt->state_id = 1;
                                    $rt->sample_id = $com->sample_id;
                                    $rt->registration_id = $com->registration_id;
                                    $rt->status_id = 1;
                                    $rt->is_group = 1;
                                    $rt->save();

                                    $samp = FoodSamples::findOne($com->sample_id);
                                    $samp->status_id = 3;
                                    $dal = FoodSamplingCertificate::findOne($samp->sert_id);
                                    $dal->status_id = 3;
                                    $dal->save();
                                    $reg->status_id = 3;
                                    $reg->save();
                                    $samp->save();
                                    $rst = new ResultFood();
                                    if ($r = ResultFood::findOne(['sample_id' => $samp->id])) {
                                        $rst = $r;
                                    }

                                    $rst->org_id = Yii::$app->user->identity->empPosts->org_id;
                                    $rst->sample_id = $com->sample_id;
                                    $rst->state_id = 1;
                                    $rst->creator_id = $route->executor_id;
                                    $rst->save();

                                    if ($req['FoodRoute']['temp']) {
                                        foreach ($req['FoodRoute']['temp'] as $k => $i) {
                                            if ($i == 1) {
                                                $tmpe = TemplateFood::findOne($k);
                                                $test = new ResultFoodTests();
                                                $test->checked = 1;
                                                $test->result_id = $rst->id;
                                                $test->template_id = $tmpe->id;
                                                $test->type_id = $tmpe->unit->type_id;
                                                $test->ch_min1 = $tmpe->min_1;
                                                $test->ch_min2 = $tmpe->min_2;
                                                $test->ch_max1 = $tmpe->max_1;
                                                $test->ch_max2 = $tmpe->max_2;
                                                $test->result = '';
                                                $test->result_2 = '';
                                                $test->change_unit_id = $tmpe->unit_id;
                                                $test->save();
                                                $test = null;
                                            }
                                        }
                                    }

                                }
                                else{
                                    $com->status_id = 2;
                                    $com->ads = $item['ads'];
                                    $com->save(false);
                                    $com->save();
                                    $samp = FoodSamples::findOne($com->sample_id);
                                    $samp->status_id = 6;
                                    $samp->save();
                                    // namunani yo'q qilish
                                    $des = new DestructionSampleFood();
                                    $des->sample_id = $com->sample_id;
                                    $des->creator_id = Yii::$app->user->id;
                                    $num = DestructionSampleFood::find()->where(['org_id' => Yii::$app->user->identity->empPosts->org_id])->max('code_id');
                                    $num = (int)$num + 1;
                                    $des->code = General::get3num(Yii::$app->user->identity->empPosts->org_id) . '-' . $num;
                                    $des->destruction_date = date('Y-m-d h:i:s');
                                    $des->state_id = 2;
                                    $des->ads = $com->ads;
                                    $des->consent_id = $req['FoodRoute']['director_id'];;
                                    $des->org_id = Yii::$app->user->identity->empPosts->org_id;
                                    $des->save();

                                    $cnt = FoodCompose::find()->where(['registration_id'=>$id])->count('sample_id');
                                    if($cnt == FoodCompose::find()->where(['registration_id'=>$id])->andWhere(['status_id'=>2])->count('sample_id')){
                                        $dal = FoodSamplingCertificate::findOne($samp->sert_id);
                                        $dal->status_id = 6;
                                        $dal->save();
                                        $reg->status_id = 6;
                                        $reg->save();
                                    }
                                }

                            }
                        }
                        Yii::$app->session->setFlash('success', 'Namunalar muvoffaqiyatli qabul qilindi va labaratoriyaga jo`natildi');
                        return $this->redirect(['regproductview', 'id' => $id]);
                    }else{

                        foreach ($cs as $key => $item) {
                            if ($com = FoodCompose::findOne(['sample_id'=>$item->sample_id])) {
                                $rt = new FoodRoute();
                                if ($rtt = FoodRoute::find()->where(['registration_id' => $id, 'sample_id' => $com->sample_id, 'is_group' => 1])->one()) {
                                    $rt = $rtt;
                                }
                                $rt->director_id = $route->director_id;
                                $rt->leader_id = $route->leader_id;
                                $rt->state_id = 1;
                                $rt->sample_id = $com->sample_id;
                                $rt->registration_id = $com->registration_id;
                                $rt->status_id = 1;
                                $rt->is_group = 1;
                                $rt->save();

                                $samp = FoodSamples::findOne($com->sample_id);
                                $samp->status_id = 3;
                                $dal = FoodSamplingCertificate::findOne($samp->sert_id);
                                $dal->status_id = 3;
                                $dal->save();
                                $reg->status_id = 3;
                                $reg->save();
                                $samp->save();
                                $rst = new ResultFood();
                                if ($r = ResultFood::findOne(['sample_id' => $samp->id])) {
                                    $rst = $r;
                                }

                                $rst->org_id = Yii::$app->user->identity->empPosts->org_id;
                                $rst->sample_id = $com->sample_id;
                                $rst->state_id = 1;
                                $rst->creator_id = $route->executor_id;
                                $rst->save();

                                if ($req['FoodRoute']['temp']) {
                                    foreach ($req['FoodRoute']['temp'] as $k => $i) {
                                        if ($i == 1) {
                                            $tmpe = TemplateFood::findOne($k);
                                            $test = new ResultFoodTests();
                                            $test->checked = 1;
                                            $test->result_id = $rst->id;
                                            $test->template_id = $tmpe->id;
                                            $test->type_id = $tmpe->unit->type_id;
                                            $test->ch_min1 = $tmpe->min_1;
                                            $test->ch_min2 = $tmpe->min_2;
                                            $test->ch_max1 = $tmpe->max_1;
                                            $test->ch_max2 = $tmpe->max_2;
                                            $test->result = '';
                                            $test->result_2 = '';
                                            $test->change_unit_id = $tmpe->unit_id;
                                            $test->save();
                                            $test = null;
                                        }
                                    }
                                }
                                Yii::$app->session->setFlash('success', 'Namunalar muvoffaqiyatli qabul qilindi va labaratoriyaga jo`natildi');
                                return $this->redirect(['regview', 'id' => $id]);
                            }
                        }
                        Yii::$app->session->setFlash('success', 'Namunalarga qo`shimcha shablonlar biriktirildi');
                        return $this->redirect(['regproductview', 'id' => $id]);
                    }
                }

            }

            $org_id = Yii::$app->user->identity->empPosts->org_id;

            $directos = Employees::find()->select(['employees.*'])->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')->where(['emp_posts.post_id' => 4])->andWhere(['emp_posts.org_id' => $org_id])->all();
            $lider = Employees::find()->select(['employees.*'])->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')->where(['emp_posts.post_id' => 3])->andWhere(['emp_posts.org_id' => $org_id])->all();

            return $this->render('incomeproductmulti',[
                'model'=>$model,
                'samples'=>$samples,
                'reg'=>$reg,
                'template'=>$template,
                'result'=>$result,
                'route'=>$route,
                'cs'=>$cs,
                'director' => $directos,
                'lider' => $lider,
            ]);




        }else{
            Yii::$app->session->setFlash('error','Namunalar mavjud emas');
            return $this->redirect(['/register/regproductview','id'=>$id]);
        }
    }

    public function actionDest(int $export = null)
    {
        $searchModel = new DestructionSampleAnimalSearch();
        $dataProvider = $searchModel->searchRegister($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfdest', ['dataProvider' => $dataProvider]),
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

        return $this->render('dest', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDestview($id)
    {
        $model = DestructionSampleAnimal::findOne($id);

        return $this->render('destview', [
            'model' => $model
        ]);
    }

    public function actionDestfood($export = null)
    {
        $searchModel = new DestructionSampleFoodSearch();
        $dataProvider = $searchModel->searchRegister($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdfdest', ['dataProvider' => $dataProvider]),
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
        return $this->render('destfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDestfoodview($id)
    {
        $model = DestructionSampleFood::findOne($id);

        return $this->render('destfoodview', [
            'model' => $model
        ]);
    }

    public function actionDestPdf($id)
    {
        $model = DestructionSampleAnimal::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }

    public function actionDestPdffood($id)
    {
        $model = DestructionSampleFood::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }


}
