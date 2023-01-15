<?php

namespace app\modules\admin\controllers;

use common\models\DistrictView;
use common\models\QfiView;
use common\models\VetSites;
use common\models\search\VetSitesSearch;
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
 * VetSitesController implements the CRUD actions for VetSites model.
 */
class VetSitesController extends Controller
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
     * Lists all VetSites models.
     * @return string
     * @throws Exception
     */
    public function actionIndex(int $export = null)
    {
        $searchModel = new VetSitesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 1) {
            $searchModel->exportToExcel($dataProvider->query);
        } elseif ($export == 2) {
            Yii::$app->response->format = Response::FORMAT_RAW;

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
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
                return $e;
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VetSites model.
     * @param int $id ID
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
     * Creates a new VetSites model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VetSites();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing VetSites model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
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
     * Deletes an existing VetSites model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VetSites model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VetSites the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VetSites::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp.vetsites', 'The requested page does not exist.'));
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
        $model = QfiView::find()->where(['district_id' => $id, 'region_id' => $regid])->all();
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

    public function actionGetVetsites($id)
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
}
