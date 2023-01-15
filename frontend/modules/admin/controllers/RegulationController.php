<?php

namespace app\modules\admin\controllers;

use common\models\Regulations;
use common\models\search\RegulationsSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;
/**
 * RegulationController implements the CRUD actions for Regulations model.
 */
class RegulationController extends Controller
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
     * Lists all Regulations models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RegulationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Regulations model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Regulations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Regulations();
        $model->status = 1;
        $model->creator_id = Yii::$app->user->id;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($file instanceof UploadedFile) {
                $fileName = microtime(true);
                $file->saveAs(Yii::$app->basePath.'/web/uploads/' . $fileName . '.' . $file->extension);
                $model->file = $fileName . '.' . $file->extension;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Regulations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $file = UploadedFile::getInstance($model, 'file');
            $lastFile = Regulations::findOne(['id' => $model->id])->file;
            if ($file instanceof UploadedFile) {
                $fileName = microtime(true);
                $file->saveAs(Yii::$app->basePath.'/web/uploads/' . $fileName . '.' . $file->extension);
                $model->file = $fileName . '.' . $file->extension;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Regulations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $lastFile = Regulations::findOne(['id' => $id])->file;

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Regulations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Regulations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Regulations::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
