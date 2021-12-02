<?php

namespace app\modules\admin\controllers;

use app\models\Animals;
use app\models\Samples;
use app\models\Sertificates;
use app\models\search\SertificatesSearch;
use app\models\Vaccination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * SertificatesController implements the CRUD actions for Sertificates model.
 */
class SertificatesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Sertificates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SertificatesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sertificates model.
     * @param string $sert_id Sert ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sertificates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sertificates();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->id = Sertificates::find()->max('id');
                if($model->id){
                    $model->id = $model->id+1;
                }else{
                    $model->id = 1;
                }
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sertificates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $sert_id Sert ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sertificates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $sert_id Sert ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sertificates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $sert_id Sert ID
     * @return Sertificates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sertificates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.sertificates', 'The requested page does not exist.'));
    }

    public function actionAdd($id){
        $model = $this->findModel($id);

        $animal = new Animals();

        $sample = new Samples();
        $animal->pnfl = $model->pnfl;
        $animal->inn = $model->organization->TIN;
        $sample->animal_id = -1;
        $sample->sert_id = intval($id);
        if(Yii::$app->request->isPost){

            if($animal->load(Yii::$app->request->post())){
                $animal->inn = "{$animal->inn}";
                if($animal->save()){}
                if($sample->load(Yii::$app->request->post())){
                    $sample->animal_id = $animal->id;
                    $sample->sert_id = intval($id);
                    if($sample->save(false)){
                        return $this->redirect(['view','id'=>$id]);
                    }
                }
            }
            echo "<pre>";
//            var_dump($animal);
            echo "________________<br><br><hr>";
            var_dump($sample);
            exit;
        }

        return $this->render('add',[
            'model'=>$model,
            'animal'=>$animal,
            'sample'=>$sample
        ]);
    }

    public function actionVaccination($id,$sert_id){

        $model = new Vaccination();
        $model->animal_id = $id;
        $animal = Animals::findOne($id);
        if($model->load(Yii::$app->request->post()) and $model->save()){
            return $this->redirect(['view','id'=>$sert_id]);
        }
        return $this->render('vaccination',['model'=>$model,'animal'=>$animal]);
    }
}
