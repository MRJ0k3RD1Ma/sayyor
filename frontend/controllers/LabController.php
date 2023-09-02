<?php

namespace frontend\controllers;


use app\models\search\lab\DestructionSampleAnimalSearch;
use app\models\search\lab\DestructionSampleFoodSearch;
use app\models\search\laboratory\FoodRouteSearch;
use common\models\DestructionSampleAnimal;
use common\models\DestructionSampleFood;
use common\models\Employees;
use common\models\FoodRecomendation;
use common\models\FoodRegistration;
use common\models\FoodRoute;
use common\models\Regulations;
use common\models\ResultAnimal;
use common\models\ResultAnimalConditions;
use common\models\ResultAnimalTests;
use common\models\ResultFood;
use common\models\ResultFoodConditions;
use common\models\ResultFoodTests;
use common\models\RouteSert;
use common\models\SampleRecomendation;
use common\models\SampleRegistration;
use common\models\search\FoodRegistrationSearch;
use common\models\search\SampleRegistrationSearch;
use common\models\TamplateAnimal;
use common\models\TaskForm;
use common\models\TemplateUnit;
use common\models\TestForm;
use Egulias\EmailValidator\Result\Result;
use frontend\models\search\laboratory\RouteSertSearch;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * Site controller
 */
class LabController extends Controller
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
        return $this->redirect(['/']);
    }

    public function actionIndexanimal($status = -1, int $export = null)
    {
        $searchModel = new SampleRegistrationSearch();
        $searchModel->status_id = $status;
        $dataProvider = $searchModel->searchLab($this->request->queryParams);

        return $this->render('indexanimal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexfood($status = -1, int $export = null)
    {
        $searchModel = new FoodRegistrationSearch();
        $searchModel->status_id = $status;
        $dataProvider = $searchModel->searchLab($this->request->queryParams);


        return $this->render('indexfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionViewreganimal($id){
        $model = SampleRegistration::findOne($id);

        $route = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['executor_id'=>Yii::$app->user->id])->andWhere(['is_group'=>0])->all();
        $route_gr = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['executor_id'=>Yii::$app->user->id])->andWhere(['is_group'=>1])->all();
        if(!RouteSert::findOne(['registration_id'=>$id,'executor_id'=>Yii::$app->user->id])){
            return "Bunday namuna topilmadi yoki bu namunani tekshirish uchun sizga ruxsat berilmagan!";
        }
        $res = ResultAnimal::findOne(['sample_id'=>RouteSert::findOne(['registration_id'=>$id,'executor_id'=>Yii::$app->user->id])->sample_id]);
        $rid = 1;
        if(!($rid = $route[0]->id)){
            $rid=$route_gr[0]->id;
        }
        $test = null;
        if(!($test = ResultAnimalConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>RouteSert::findOne(['registration_id'=>$id,'executor_id'=>Yii::$app->user->id])->sample_id]))){
            $test = new ResultAnimalConditions();
            $test->route_id = $model->id;
            $test->result_id = $res->id;
            $test->is_another = 0;
            $test->save();
        }

        if($test->load(Yii::$app->request->post())){

            foreach ($route as $item){
                $result = [];
                if(!($result = ResultAnimalConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>$item->sample_id]))){
                    $result = new ResultAnimalConditions();
                }
                $result->route_id = $item->id;
                $result->result_id = ResultAnimal::findOne(['sample_id'=>$item->sample_id])->id;
                $result->sample_id = $item->sample_id;
                $result->temprature = $test->temprature;
                $result->humidity = $test->humidity;
                $result->reagent_name = $test->reagent_name;
                $result->reagent_series = $test->reagent_series;
                $result->conditions = $test->conditions;
                $result->end_date = $test->end_date;
                $result->save(false);
            }
            foreach ($route_gr as $item){
                $result = [];
                if(!($result = ResultAnimalConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>$item->sample_id]))){
                    $result = new ResultAnimalConditions();
                }
                $result->route_id = $item->id;
                $result->result_id = ResultAnimal::findOne(['sample_id'=>$item->sample_id])->id;
                $result->sample_id = $item->sample_id;
                $result->temprature = $test->temprature;
                $result->humidity = $test->humidity;
                $result->reagent_name = $test->reagent_name;
                $result->reagent_series = $test->reagent_series;
                $result->conditions = $test->conditions;
                $result->end_date = $test->end_date;
                $result->save(false);
            }
            Yii::$app->session->setFlash('success','Tekshiruv shartoitlari kiritildi.');
            return $this->refresh();
        }

        return $this->render('viewreganimal',[
            'model'=>$model,
            'route'=>$route,
            'route_gr'=>$route_gr,
            'test'=>$test,
        ]);
    }


    public function actionViewregfood($id){
        $model = FoodRegistration::findOne($id);

        $route = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['executor_id'=>Yii::$app->user->id])->andWhere(['is_group'=>0])->all();
        $route_gr = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['executor_id'=>Yii::$app->user->id])->andWhere(['is_group'=>1])->all();
        $res = ResultFood::findOne(['sample_id'=>FoodRoute::findOne(['registration_id'=>$id])->sample_id]);

        $rid = 1;
        if(!($rid = $route[0]->id)){
            $rid=$route_gr[0]->id;
        }
        $test = null;
        if(!($test = ResultFoodConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>FoodRoute::findOne(['registration_id'=>$id,'executor_id'=>Yii::$app->user->id])->sample_id]))){
            $test = new ResultFoodConditions();
            $test->route_id = $model->id;
            $test->result_id = $res->id;
            $test->save();
        }
        if($test->load(Yii::$app->request->post())){

            foreach ($route as $item){
                $result = [];
                if(!($result = ResultFoodConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>$item->sample_id]))){
                    $result = new ResultFoodConditions();
                }
                $result->route_id = $item->id;
                $result->sample_id = $item->sample_id;
                $result->result_id = ResultFood::findOne(['sample_id'=>$item->sample_id])->id;
                $result->temprature = $test->temprature;
                $result->humidity = $test->humidity;
                $result->reagent_name = $test->reagent_name;
                $result->reagent_series = $test->reagent_series;
                $result->conditions = $test->conditions;
                $result->end_date = $test->end_date;
                $result->save(false);
            }
            foreach ($route_gr as $item){
                $result = [];
                if(!($result = ResultFoodConditions::findOne(['route_id'=>$rid,'result_id'=>$res->id,'sample_id'=>$item->sample_id]))){
                    $result = new ResultFoodConditions();
                }
                $result->route_id = $item->id;
                $result->sample_id = $item->sample_id;
                $result->result_id = ResultFood::findOne(['sample_id'=>$item->sample_id])->id;
                $result->temprature = $test->temprature;
                $result->humidity = $test->humidity;
                $result->reagent_name = $test->reagent_name;
                $result->reagent_series = $test->reagent_series;
                $result->conditions = $test->conditions;
                $result->end_date = $test->end_date;
                $result->save(false);
            }
            Yii::$app->session->setFlash('success','Tekshiruv shartoitlari kiritildi.');
            return $this->refresh();
        }
        return $this->render('viewregfood',[
            'model'=>$model,
            'route'=>$route,
            'route_gr'=>$route_gr,
            'test'=>$test,
        ]);
    }


    public
    function actionViewanimal($id)
    {
        $model = RouteSert::findOne($id);
        $sample = $model->sample;

        $result = ResultAnimal::findOne(['sample_id' => $sample->id]);

        $recom = new SampleRecomendation();
        $test = ResultAnimalTests::find()->indexBy('id')->where(['route_id'=>$id,'result_id'=>$result->id])->all();
        $conditions = null;
        if(!($conditions = ResultAnimalConditions::findOne(['route_id'=>$model->id,'result_id'=>$result->id,'sample_id'=>$sample->id]))){
            $conditions = new ResultAnimalConditions();
            $conditions->sample_id = $sample->id;
            $conditions->route_id = $model->id;
            $conditions->result_id = $result->id;
            $conditions->is_another = 0;
            $conditions->save();
        }

        if($recom->load(Yii::$app->request->post())){
            $recom->sample_id = $sample->id;
            $recom->save();
            return $this->refresh();
        }
        if($conditions->load(Yii::$app->request->post())){
            if($conditions->is_change == 0){
                $conditions->why_change = "";
            }
            $conditions->save();
        }
        if (Model::loadMultiple($test, Yii::$app->request->post())) {

            foreach ($test as $item) {


                if($conditions->is_change == 0){
                    $item->is_change = 0;
                }
                $type = $item->unit->type_id;

                if($item->is_change == 0){
                    $item->change_unit_id = $item->template->unit_id;
                    $item->ch_min1 = $item->template->min;
                    $item->ch_max1 = $item->template->max;
                    $item->ch_max2 = $item->template->max_1;
                    $item->ch_min2 = $item->template->min_1;

                }else{
                    if($type == 2){
                        $item->ch_min1 = $item->true1;
                        $item->ch_max1 = $item->true2;
                    }elseif($type == 5){
                        $item->ch_min1 = $item->mm_1;
                        $item->ch_max1 = $item->mm_2;
                    }

                }
                $type = $item->unit->type_id;

                if($type == 1){
                    $item->result = $item->r_son;
                }elseif($type == 2){
                    $item->result = $item->r_bool;
                }elseif($type == 3){
                    $item->result = $item->r_text;
                }elseif($type == 4){
                    $item->result = $item->r_1;
                    $item->result_2 = $item->r_2;
                }elseif($type == 5){
                    $item->result = $item->r_unit;
                }
                if(!$item->save()){
                    echo "<pre>";
                    var_dump($item);
                    exit;
                }
            }
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Natijalar muvoffaqiyatli saqlandi'));

            return $this->redirect(['viewanimal', 'id' => $id]);
        }

        $docs = Regulations::find()->select(['regulations.*'])->innerJoin('template_animal_regulations', 'template_animal_regulations.regulation_id = regulations.id')
            ->innerJoin('tamplate_animal', 'tamplate_animal.id=template_animal_regulations.template_id')
            ->where('tamplate_animal.id in (select result_animal_tests.template_id from result_animal_tests where result_id=' . $result->id . ')')
            ->groupBy('regulations.id')->all();
        $result->scenario = 'lab';
        return $this->render('viewanimal', [
            'model' => $model,
            'sample' => $sample,
            'result' => $result,
            'test' => $test,
            'docs' => $docs,
            'recom'=>$recom,
            'conditions'=>$conditions
        ]);
    }

    public  function actionSendanimal($id)
    {

        $model = RouteSert::findOne($id);

        $result = ResultAnimal::findOne(['sample_id'=>$model->sample_id]);
        $res = ResultAnimalConditions::findOne([
            'route_id'=>$model->id,
            'sample_id'=>$model->sample_id,
            'result_id'=>$result->id
        ]);

        $n=0;
        $true = false;

        foreach ($res->getAttributes() as $key=>$item){
            $n++;
            if($n>13){
                if($item!=0){
                    $true = true;
                }
            }
        }

        if($true){
            if($res->ads != null){
                $model->status_id = 4;
                $model->save();
                Yii::$app->session->setFlash('success', Yii::t('lab', 'Natijalar muvoffaqiyatli yuborildi'));
            }else{
                Yii::$app->session->setFlash('error', Yii::t('lab', 'Umumlashgan natija kiritlmagan'));
            }
        }else{
            Yii::$app->session->setFlash('error', Yii::t('lab', 'O\'tkazilgan tekshiruv natijalari kiritlmagan'));
        }
        return $this->redirect(['viewanimal', 'id' => $id]);

    }

    public
    function actionDest(int $export = null)
    {
        $searchModel = new DestructionSampleAnimalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

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

    public
    function actionDestview($id)
    {
        $model = DestructionSampleAnimal::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->state_id = 2;

            $model->destruction_date = date('Y-m-d h:i:s');
            $model->save();
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Namuna yo\'q qilish dalolatnomasi tasdiqlash uchun rahbarga yuborildi'));
            return $this->redirect(['dest']);
        }
        return $this->render('destview', [
            'model' => $model
        ]);
    }



    public
    function actionViewfood($id)
    {
        $model = FoodRoute::findOne($id);
        $sample = $model->sample;

        $recom = new FoodRecomendation();
        if($recom->load(Yii::$app->request->post())){
            $recom->sample_id = $sample->id;
            $recom->save();
            return $this->refresh();
        }

        $result = ResultFood::findOne(['sample_id' => $sample->id]);

        $test = ResultFoodTests::find()->indexBy('id')->where(['result_id' => $result->id,'route_id'=>$model->id])->all();

        $conditions = null;
        if(!($conditions = ResultFoodConditions::findOne(['route_id'=>$model->id,'result_id'=>$result->id,'sample_id'=>$sample->id]))){
            $conditions = new ResultFoodConditions();
            $conditions->sample_id = $sample->id;
            $conditions->route_id = $model->id;
            $conditions->result_id = $result->id;
            $conditions->save();
        }

        if($conditions->load($this->request->post())){
            if($conditions->is_change == 0){
                $conditions->why_change = "";
            }
            $conditions->save();
            $result->creator_id = Yii::$app->user->id;
            $result->save();
        }

        if (Model::loadMultiple($test, Yii::$app->request->post())) {

            foreach ($test as $item) {

                if($conditions->is_change == 0){
                    $item->is_change = 0;
                }

                if($item->is_change == 0){
                    $item->change_unit_id = $item->template->unit_id;
                    $item->ch_min1 = $item->template->min_1;
                    $item->ch_max1 = $item->template->max_1;
                    $item->ch_max2 = $item->template->max_2;
                    $item->ch_min2 = $item->template->min_2;
                }else{
                    $type = $item->unit->type_id;
                    if($type == 2){
                        $item->ch_min1 = $item->true1;
                        $item->ch_max1 = $item->true2;
                    }elseif($type == 5){
                        $item->ch_min1 = $item->mm_1;
                        $item->ch_max1 = $item->mm_2;
                    }

                }
                $type = $item->unit->type_id;

                if($type == 1){
                    $item->result = $item->r_son;
                }elseif($type == 2){
                    $item->result = $item->r_bool;
                }elseif($type == 3){
                    $item->result = $item->r_text;
                }elseif($type == 4){
                    $item->result = $item->r_1;
                    $item->result_2 = $item->r_2;
                }elseif($type == 5){
                    $item->result = $item->r_unit;
                }
                if(!$item->save()){
                    echo "<pre>";
                    var_dump($item);
                    exit;
                }

            }
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Natijalar muvoffaqiyatli saqlandi'));

            return $this->redirect(['viewfood', 'id' => $id]);
        }
        $docs = Regulations::find()->select(['regulations.*'])->innerJoin('template_food_regulations', 'template_food_regulations.regulation_id = regulations.id')
            ->innerJoin('template_food', 'template_food_regulations.template_id = template_food.id')
            ->orderBy('template_food_regulations.regulation_id')
            ->where('template_food.id IN (SELECT result_food_tests.id from result_food_tests inner join template_food on result_food_tests.template_id=template_food.id where result_food_tests.result_id=' . $result->id . ')')->all();;
        $result->scenario = 'lab';
        return $this->render('viewfood', [
            'model' => $model,
            'sample' => $sample,
            'result' => $result,
            'test' => $test,
            'docs' => $docs,
            'recom'=>$recom,
            'conditions'=>$conditions,

        ]);
    }

    public
    function actionSendfood($id)
    {
        $model = FoodRoute::findOne($id);
        $model->status_id = 4;
        $sample = ResultFoodConditions::findOne(['sample_id'=>$model->sample_id,'result_id'=>ResultFood::findOne(['sample_id'=>$model->sample_id])->id,'route_id'=>$model->id]);
        if($sample->radiologik==0 and $sample->kimyoviy==0 and $sample->mikrobiologik==0 and $sample->mikroskopik==0 and $sample->organoleptik==0){
            Yii::$app->session->setFlash('error', Yii::t('lab', 'Vet4 uchun natijalar kiritilmagan'));
            return $this->redirect(['viewfood', 'id' => $id]);
        }
        $model->save();
        Yii::$app->session->setFlash('success', Yii::t('lab', 'Natijalar muvoffaqiyatli yuborildi'));
        return $this->redirect(['viewfood', 'id' => $id]);
    }


    public
    function actionDestfood($export = null)
    {
        $searchModel = new DestructionSampleFoodSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;

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
            } catch (MpdfException|CrossReferenceException|PdfTypeException|PdfParserException|InvalidConfigException $e) {
                return $e;
            }
        }
        return $this->render('destfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public
    function actionDestfoodview($id)
    {
        $model = DestructionSampleFood::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->state_id = 2;
            $model->destruction_date = date('Y-m-d h:i:s');
            $model->save();
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Namuna yo\'q qilish dalolatnomasi tasdiqlash uchun rahbarga yuborildi'));
            return $this->redirect(['destfood']);
        }
        return $this->render('destfoodview', [
            'model' => $model
        ]);
    }

    public
    function actionDestPdf($id)
    {
        $model = DestructionSampleAnimal::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }

    public
    function actionDestPdffood($id)
    {
        $model = DestructionSampleFood::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }


    public function actionGetbirlik($id){
        if($model = TemplateUnit::findOne($id)){
            return $model->type_id;
        }else{
            return 0;
        }
    }
}
