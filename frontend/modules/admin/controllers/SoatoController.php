<?php

namespace app\modules\admin\controllers;

use common\models\Soato;
use common\models\search\SoatoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * SoatoController implements the CRUD actions for Soato model.
 */
class SoatoController extends Controller
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
     * Lists all Soato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SoatoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Soato model.
     * @param int $MHOBT_cod Mhobt Cod
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($MHOBT_cod)
    {
        return $this->render('view', [
            'model' => $this->findModel($MHOBT_cod),
        ]);
    }

    /**
     * Creates a new Soato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Soato();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'MHOBT_cod' => $model->MHOBT_cod]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Soato model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $MHOBT_cod Mhobt Cod
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($MHOBT_cod)
    {
        $model = $this->findModel($MHOBT_cod);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'MHOBT_cod' => $model->MHOBT_cod]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Soato model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $MHOBT_cod Mhobt Cod
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($MHOBT_cod)
    {
        $this->findModel($MHOBT_cod)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Soato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $MHOBT_cod Mhobt Cod
     * @return Soato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($MHOBT_cod)
    {
        if (($model = Soato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp', 'The requested page does not exist.'));
    }
}
