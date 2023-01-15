<?php

namespace app\modules\admin\controllers;

use common\models\Animals;
use common\models\Emlash;
use common\models\Samples;
use common\models\Sertificates;
use common\models\search\SertificatesSearch;
use common\models\Vaccination;
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
    public function actionIndex(int $export=null)
    {
        $searchModel = new SertificatesSearch();
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

    public function actionEmlash($id,$sert_id){

        $model = new Emlash();
        $model->animal_id = $id;
        $animal = Animals::findOne($id);
        if($model->load(Yii::$app->request->post()) and $model->save()){
            return $this->redirect(['view','id'=>$sert_id]);
        }
        return $this->render('emlash',['model'=>$model,'animal'=>$animal]);
    }


}
