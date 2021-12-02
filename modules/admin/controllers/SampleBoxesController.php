<?php

namespace app\modules\admin\controllers;

use app\models\SampleBoxes;
use app\models\search\SampleBoxesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SampleBoxesController implements the CRUD actions for SampleBoxes model.
 */
class SampleBoxesController extends Controller
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
     * Lists all SampleBoxes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SampleBoxesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SampleBoxes model.
     * @param int $id ID
     * @param string $name_uz Name Uz
     * @param string $name_ru Name Ru
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $name_uz, $name_ru)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $name_uz, $name_ru),
        ]);
    }

    /**
     * Creates a new SampleBoxes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SampleBoxes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SampleBoxes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param string $name_uz Name Uz
     * @param string $name_ru Name Ru
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $name_uz, $name_ru)
    {
        $model = $this->findModel($id, $name_uz, $name_ru);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SampleBoxes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param string $name_uz Name Uz
     * @param string $name_ru Name Ru
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $name_uz, $name_ru)
    {
        $this->findModel($id, $name_uz, $name_ru)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SampleBoxes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param string $name_uz Name Uz
     * @param string $name_ru Name Ru
     * @return SampleBoxes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $name_uz, $name_ru)
    {
        if (($model = SampleBoxes::findOne(['id' => $id, 'name_uz' => $name_uz, 'name_ru' => $name_ru])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.sample_boxes', 'The requested page does not exist.'));
    }
}
