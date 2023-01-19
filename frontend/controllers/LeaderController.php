<?php

namespace frontend\controllers;



use common\models\CompositeSamples;
use common\models\DestructionSampleAnimal;
use common\models\Employees;

use common\models\FoodCompose;
use common\models\FoodRegistration;
use common\models\FoodRoute;
use common\models\FoodSamples;
use common\models\Regulations;
use common\models\ResultAnimal;
use common\models\ResultAnimalConditions;
use common\models\ResultAnimalTests;
use common\models\ResultFood;
use common\models\ResultFoodTests;
use common\models\ResultsConformity;
use common\models\RouteSert;
use common\models\SampleRegistration;
use common\models\Samples;
use common\models\search\FoodRegistrationSearch;
use common\models\search\SampleRegistrationSearch;
use common\models\TaskForm;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;

/**
 * Site controller
 */
class LeaderController extends Controller
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
        return $this->render('/site/index');
    }

    public function actionIndexanimal($status = -1, int $export = null)
    {
        $searchModel = new SampleRegistrationSearch();
        $searchModel->status_id = $status;
        $dataProvider = $searchModel->searchLeader($this->request->queryParams);


        return $this->render('indexanimal', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexfood($status = null, int $export = null)
    {
        $searchModel = new FoodRegistrationSearch();
        $searchModel->status_id = $status;
        $dataProvider = $searchModel->searchLeader($this->request->queryParams);


        return $this->render('indexfood', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionViewreganimal($id){
        $model = SampleRegistration::findOne($id);
        $route = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['is_group'=>0])->all();
        $route_gr = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['is_group'=>1])->all();

        $cnt_4 = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['=','status_id',4])->count('id');
        $cnt_5 = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['=','status_id',5])->count('id');
        $cnt_not = $cnt_4+$cnt_5-count($route)-count($route_gr);

        if($cnt_4 == 0){
            $cnt_not = 1;
        }
        if($model->load(Yii::$app->request->post()) and $cnt_not==0){
            if($model->save()){
                foreach ($route_gr as $item){
                    $item->status_id=5;
                    $item->save();
                }
                foreach ($route as $item){
                    $item->status_id=5;
                    $item->save();
                }
                Yii::$app->session->setFlash('success','Namunalar muvoffaqiyatli tasdiqlandi');
                return $this->refresh();
            }
        }


        $task = new TaskForm();
        if($task->load(Yii::$app->request->post())){
            $cnt = 0;
            foreach ($task->id as $key => $item){
                if($item == 1){
                    $r = RouteSert::findOne($key);
                    $r->ads = $task->ads;
                    $r->executor_id = $task->executor_id;
                    $r->deadline = $task->deadline;
                    $r->status_id = 2;
                    if($r->save(false)){
                        $cnt ++;
                    }
                }
            }
            Yii::$app->session->setFlash('success',$cnt.' ta namuna labaratoriya tekshiruvlari uchun yuborildi.');
            return $this->refresh();
        }
        $emp = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 2])
            ->andWhere(['emp_posts.org_id' => Yii::$app->user->identity->empPosts->org_id])
            ->andWhere(['emp_posts.gov_id' => Yii::$app->user->identity->empPosts->gov_id])->all();

        $cnt_not = RouteSert::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['<>','status_id',4])->count('id');

        return $this->render('viewreganimal',[
            'model'=>$model,
            'route'=>$route,
            'route_gr'=>$route_gr,
            'task'=>$task,
            'emp'=>$emp,
            'cnt_not'=>$cnt_not
        ]);
    }


    public function actionViewregfood($id){
        $model = FoodRegistration::findOne($id);

        $route = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['is_group'=>0])->all();
        $route_gr = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['is_group'=>1])->all();

        $cnt_4 = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['=','status_id',4])->count('id');
        $cnt_5 = FoodRoute::find()->where(['registration_id'=>$id])->andWhere(['leader_id'=>Yii::$app->user->id])->andWhere(['=','status_id',5])->count('id');
        $cnt_not = $cnt_4+$cnt_5-count($route)-count($route_gr);
        if($cnt_4 == 0){
            $cnt_not = 1;
        }
        if($model->load(Yii::$app->request->post()) and $cnt_not==0){
            if($model->save()){
                foreach ($route_gr as $item){
                    $item->status_id=5;
                    $item->save();
                }
                foreach ($route as $item){
                    $item->status_id=5;
                    $item->save();
                }
                Yii::$app->session->setFlash('success','Namunalar muvoffaqiyatli tasdiqlandi');
                return $this->refresh();
            }
        }


        $task = new TaskForm();
        if($task->load(Yii::$app->request->post())){
            $cnt = 0;
            foreach ($task->id as $key => $item){
                if($item == 1){
                    $r = FoodRoute::findOne($key);
                    $r->ads = $task->ads;
                    $r->executor_id = $task->executor_id;
                    $r->deadline = $task->deadline;
                    $r->status_id = 2;
                    if($r->save(false)){
                        $cnt ++;
                    }
                }
            }
            Yii::$app->session->setFlash('success',$cnt.' ta namuna labaratoriya tekshiruvlari uchun yuborildi.');
            return $this->refresh();
        }
        $emp = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 2])
            ->andWhere(['emp_posts.org_id' => Yii::$app->user->identity->empPosts->org_id])
            ->andWhere(['emp_posts.gov_id' => Yii::$app->user->identity->empPosts->gov_id])->all();
        return $this->render('viewregfood',[
            'model'=>$model,
            'route'=>$route,
            'route_gr'=>$route_gr,
            'task'=>$task,
            'emp'=>$emp,
            'cnt_not'=>$cnt_not,
        ]);
    }


    public function actionViewanimal($id)
    {
        $model = RouteSert::findOne($id);
        $sample = $model->sample;
        $emp = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 2])
            ->andWhere(['emp_posts.org_id' => Yii::$app->user->identity->empPosts->org_id])
            ->andWhere(['emp_posts.gov_id' => Yii::$app->user->identity->empPosts->gov_id])->all();
        $model->scenario = 'exec';
        if ($model->load(Yii::$app->request->post())) {
            $model->status_id = 2;
            $sam = Samples::findOne($model->sample_id);
            $sam->status_id = 4;
            $sam->save();
            $cs = CompositeSamples::findOne(['sample_id' => $sam->id]);
            $reg = SampleRegistration::findOne(['id' => $cs->registration_id]);
            $reg->status_id = 4;
            $reg->save();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('leader', 'Topshiriq muvoffaqiyatli yuborildi'));
                return $this->redirect(['viewanimal', 'id' => $id]);
            }
        }

        $result = ResultAnimal::findOne(['sample_id' => $sample->id]);
        $test = ResultAnimalTests::find()->indexBy('id')->where(['result_id' => $result->id,'route_id'=>$model->id])->andWhere(['checked' => 1])->all();
        $conditions = null;
        if(!($conditions = ResultAnimalConditions::findOne(['route_id'=>$model->id,'result_id'=>$result->id,'sample_id'=>$sample->id]))){
            $conditions = new ResultAnimalConditions();
            $conditions->sample_id = $sample->id;
            $conditions->route_id = $model->id;
            $conditions->result_id = $result->id;
            $conditions->is_another = 0;
            $conditions->save();
        }
        $docs = Regulations::find()->select(['regulations.*'])->innerJoin('template_animal_regulations', 'template_animal_regulations.regulation_id = regulations.id')
            ->innerJoin('tamplate_animal', 'tamplate_animal.id=template_animal_regulations.template_id')
            ->where('tamplate_animal.id in (select result_animal_tests.template_id from result_animal_tests where result_id=' . $result->id . ')')
            ->groupBy('regulations.id')->all();

        return $this->render('viewanimal', [
            'model' => $model,
            'sample' => $sample,
            'result' => $result,
            'emp' => $emp,
            'test' => $test,
            'docs' => $docs,
            'conditions'=>$conditions
        ]);
    }

    public function actionDeclineanimal($id)
    {
        $model = RouteSert::findOne(['id' => $id]);
        $model->status_id = 6;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('leader', 'Natija rad etildi'));
        }
        return $this->redirect(['indexanimal']);

    }

    public function actionAcceptanimal($id)
    {
        $model = RouteSert::findOne(['id' => $id]);
        $model->status_id = 5;
        if ($model->save()) {

            Yii::$app->session->setFlash('success', Yii::t('leader', 'Natija tasdiqlandi'));
        }
        return $this->redirect(['indexanimal']);

    }


    public function actionViewfood($id)
    {
        $model = FoodRoute::findOne($id);
        $sample = $model->sample;
        $emp = Employees::find()->select(['employees.*'])
            ->innerJoin('emp_posts', 'emp_posts.emp_id = employees.id')
            ->where(['emp_posts.post_id' => 2])
            ->andWhere(['emp_posts.org_id' => Yii::$app->user->identity->empPosts->org_id])
            ->andWhere(['emp_posts.gov_id' => Yii::$app->user->identity->empPosts->gov_id])->all();

        $model->scenario = 'send';

        if ($model->load(Yii::$app->request->post())) {
            $model->status_id = 2;
            $sam = FoodSamples::findOne($model->sample_id);
            $sam->status_id = 4;
            $sam->save();
            $cs = FoodCompose::findOne(['sample_id' => $sam->id]);

            $reg = FoodRegistration::findOne(['id' => $cs->registration_id]);
            $reg->status_id = 4;
            $reg->save();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('leader', 'Topshiriq muvoffaqiyatli yuborildi'));
                return $this->redirect(['viewfood', 'id' => $id]);
            }
        }
        $result = ResultFood::findOne(['sample_id' => $sample->id]);
        $test = ResultFoodTests::find()->indexBy('id')->where(['result_id' => $result->id])->andWhere(['checked' => 1])->all();

        $docs = Regulations::find()->select(['regulations.*'])->innerJoin('template_food_regulations', 'template_food_regulations.regulation_id = regulations.id')
            ->innerJoin('template_food', 'template_food_regulations.template_id = template_food.id')
            ->orderBy('template_food_regulations.regulation_id')
            ->where('template_food.id IN (SELECT result_food_tests.id from result_food_tests inner join template_food on result_food_tests.template_id=template_food.id where result_food_tests.result_id=' . $result->id . ')')->all();;

        return $this->render('viewfood', [
            'model' => $model,
            'sample' => $sample,
            'result' => $result,
            'emp' => $emp,
            'test' => $test,
            'docs' => $docs
        ]);
    }

    public function actionAcceptfood($id)
    {
        $model = FoodRoute::findOne($id);
        $model->status_id = 5;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Natija muvoffaqiyatli tasdiqlandi. Natija rahbar tasdiqlashi uchun yuborildi.'));

        }
        return $this->redirect(['viewfood', 'id' => $id]);
    }

    public function actionDeclinefood($id)
    {
        $model = FoodRoute::findOne($id);
        $model->status_id = 6;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('lab', 'Natija muvoffaqiyatli rad qilindi.'));
        }
        return $this->redirect(['viewfood', 'id' => $id]);
    }

    public function actionDestPdf($id)
    {
        $model = DestructionSampleAnimal::findOne(['id' => $id]);
        $fileName = Yii::getAlias('@uploads') . "/../pdf/" . $model::tableName() . "_" . $model->id . ".pdf";
        header('Content-Disposition: attachment; name=' . $fileName);
        $file = fopen($fileName, 'r+');
        Yii::$app->response->sendFile($fileName, $model::tableName() . "_" . $model->id . ".pdf", ['inline' => false, 'mimeType' => 'application/pdf'])->send();
    }


}
