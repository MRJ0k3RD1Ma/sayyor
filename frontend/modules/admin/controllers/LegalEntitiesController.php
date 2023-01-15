<?php

namespace app\modules\admin\controllers;

use common\models\LegalEntities;
use common\models\search\LegalEntitiesSearch;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\Response;

/**
 * LegalEntitiesController implements the CRUD actions for LegalEntities model.
 */
class LegalEntitiesController extends Controller
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
     * Lists all LegalEntities models.
     * @return mixed
     */
    public function actionIndex(int $export=null)
    {
        $searchModel = new LegalEntitiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            try {
                $searchModel->exportToExcel($dataProvider->query);
            } catch (\Exception|Exception $e) {
                return $e->getMessage();
            }
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;
            $dataProvider->pagination->pageSize = -1;
            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_pdf', ['dataProvider' => $dataProvider]),
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
                return $e->getMessage();
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LegalEntities model.
     * @param string $inn Inn
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id ),
        ]);
    }

    /**
     * Creates a new LegalEntities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LegalEntities();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->inn]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LegalEntities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $inn Inn
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->inn]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LegalEntities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $inn Inn
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel(['inn'=>$id])->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LegalEntities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $inn Inn
     * @return LegalEntities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LegalEntities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.legal_entities', 'The requested page does not exist.'));
    }
}
