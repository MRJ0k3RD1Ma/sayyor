<?php

namespace app\modules\admin\controllers;

use common\models\Employees;
use common\models\EmpPosts;
use common\models\search\EmployeesSearch;
use kartik\mpdf\Pdf;
use Mpdf\MpdfException;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\Response;

/**
 * EmployeesController implements the CRUD actions for Employees model.
 */
class EmployeesController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                        'del' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Employees models.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionIndex(int $export = null)
    {
        $searchModel = new EmployeesSearch();
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

    public function actionAdd($id)
    {
        $model = new EmpPosts();
        $model->emp_id = $id;
        $model->state_id = 1;
        if ($m = EmpPosts::findOne(['emp_id'=>$model->emp_id])) {
            $model->org_id = $m->org_id;
        }
        if ($model->load(Yii::$app->request->post()) and $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }


        return $this->render('add', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single Employees model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employees model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new Employees();
        $model->scenario = 'insert';
        $org = new EmpPosts();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->password = "{$model->password}";
                $model->encrypt();

                if ($model->save()) {
                    if ($org->load(Yii::$app->request->post())) {
                        $org->emp_id = $model->id;
                        $org->state_id = 1;
                        $org->status_id = 1;
                        $org->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'org' => $org
        ]);
    }

    /**
     * Updates an existing Employees model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pas = $model->password;
        $model->password = "";
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->password) {
                $model->password = "{$model->password}";
                $model->encrypt();
            } else {
                $model->password = $pas;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employees model.
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
     * Finds the Employees model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employees the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employees::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp', 'The requested page does not exist.'));
    }

    public function actionDel($id)
    {
        $model = EmpPosts::findOne($id);
        $i = $model->emp_id;
        if ($model->delete()) ;
        return $this->redirect(['view', 'id' => $i]);
    }

}
