<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Region;
use app\models\search\RegionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only'=>['profile'],
                'user'=>'admin',
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Region models.
     * @return mixed
     */
    public function actionIndex($id=null)
    {
        $searchModel = new RegionSearch();
        $query = Yii::$app->request->queryParams;


        if($id!=null){
            $query['RegionSearch']['country_id'] = $id;
        }
        $dataProvider = $searchModel->search($query);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'country_id'=>$id
        ]);
    }

    /*public function actionIndex($subCategoryCode=null,$userCode=null,$subjectCode=null)
    {
        $searchModel = new UserQuestionSearch();
        $query=Yii::$app->request->queryParams;
        if(!$query['UserQuestionSearch']['subject_id'])
            $query['UserQuestionSearch']['subject_id']=Subject::getIdfromcode($subjectCode);
        if(!$query['UserQuestionSearch']['sub_category_id'])
            $query['UserQuestionSearch']['sub_category_id']=UserSubCategory::getIdfromcode($subCategoryCode);
        if(!$query['UserQuestionSearch']['user_id'])
            $query['UserQuestionSearch']['user_id']=User::getIdfromcode($userCode);
        $dataProvider = $searchModel->search($query);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subCategoryCode' => $subCategoryCode,
            'userCode' => $userCode,
            'subjectCode'=>$subjectCode,
        ]);
    }*/
    /**
     * Displays a single Region model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($country_id = null)
    {
        $model = new Region();
        if($country_id!=null){
            $model->country_id = $country_id;
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->code = GenerateRandomUnicalString(Region::find());
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Region model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Region model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Region::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
