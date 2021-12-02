<?php

namespace app\modules\admin\controllers;

use app\models\Sertificates;
use app\models\search\SertificatesSearch;
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
    public function actionView($sert_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sert_id),
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
                    return $this->redirect(['view', 'sert_id' => $model->sert_id]);
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
    public function actionUpdate($sert_id)
    {
        $model = $this->findModel($sert_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sert_id' => $model->sert_id]);
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
    public function actionDelete($sert_id)
    {
        $this->findModel($sert_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sertificates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $sert_id Sert ID
     * @return Sertificates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sert_id)
    {
        if (($model = Sertificates::findOne(['sert_id'=>$sert_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.sertificates', 'The requested page does not exist.'));
    }
}
