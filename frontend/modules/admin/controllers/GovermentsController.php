<?php

namespace app\modules\admin\controllers;

use common\models\Goverments;
use common\models\search\GovermentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GovermentsController implements the CRUD actions for Goverments model.
 */
class GovermentsController extends Controller
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
     * Lists all Goverments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GovermentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goverments model.
     * @param int $id ID
     * @param string $name_uz Nomi(UZ)
     * @param string $name_ru Nomi(RU)
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $name_uz, $name_ru)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $name_uz, $name_ru),
        ]);
    }

    /**
     * Creates a new Goverments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Goverments();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->id = Goverments::find()->max('id') + 1;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id, 'name_uz' => $model->name_uz, 'name_ru' => $model->name_ru]);
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
     * Updates an existing Goverments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @param string $name_uz Nomi(UZ)
     * @param string $name_ru Nomi(RU)
     * @return string|\yii\web\Response
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
     * Deletes an existing Goverments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @param string $name_uz Nomi(UZ)
     * @param string $name_ru Nomi(RU)
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $name_uz, $name_ru)
    {
        $this->findModel($id, $name_uz, $name_ru)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goverments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @param string $name_uz Nomi(UZ)
     * @param string $name_ru Nomi(RU)
     * @return Goverments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $name_uz, $name_ru)
    {
        if (($model = Goverments::findOne(['id' => $id, 'name_uz' => $name_uz, 'name_ru' => $name_ru])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
