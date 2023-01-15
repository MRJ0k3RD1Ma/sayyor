<?php

namespace app\modules\admin\controllers;

use common\models\OrganizationType;
use common\models\search\OrganizationTypeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * OrganizationTypeController implements the CRUD actions for OrganizationType model.
 */
class OrganizationTypeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all OrganizationType models.
     * @return mixed
     */
    public function actionIndex($export = null)
    {
        $searchModel = new OrganizationTypeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($export == 'excel') {

            $attributes = new OrganizationType();
            $attributes = $attributes->attributeLabels();
            $persondata = $dataProvider->query->all();

            $data = \yii\helpers\ArrayHelper::toArray($persondata, [
                'app\models\OrganizationType' => $attributes]);

            $labels = $dataProvider->getModels()[0]->attributeLabels();
            $label = ['Т\р'];

            $n=0;
            $outpul = expexcel($attributes,$labels);
            foreach ($persondata as $item){

                $n++;
                $outpul .= "<tr>";
                $outpul.="<td>$n</td>";

                foreach ($attributes as $i){
                    if($i=='Т\р'){
                        continue;
                    }

                    if($i == 'id'){
                        $outpul .= "<td>{$item->id}</td>";
                    }
                    if($i == 'name'){
                        $outpul .= "<td>{$item->name}</td>";
                    }
                }
                $outpul .= "</tr>";
            }

            $outpul .= "</table></body></html>";

            header("Content-Disposition: attachment; filename=\"report.xls\"");
            header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
            echo $outpul;
            exit;

        }

            return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrganizationType model.
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
     * Creates a new OrganizationType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrganizationType();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrganizationType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrganizationType model.
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
     * Finds the OrganizationType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrganizationType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrganizationType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('cp', 'The requested page does not exist.'));
    }
}
