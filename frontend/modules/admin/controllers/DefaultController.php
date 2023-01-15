<?php

namespace app\modules\admin\controllers;

use common\models\Diseases;
use common\models\Employees;
use common\models\SampleTypes;
use Yii;
use common\models\LoginForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['login'],
                        'roles'=> ['?']
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionLogin(){

        $this->layout = "login";
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/cp/default/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/cp/default/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionInside(){
        return $this->render('inside');
    }
    public function actionTemplates(){
        return $this->render('templates');
    }

    public function actionOutside(){
        return $this->render('outside');
    }

    public function actionSert(){
        return $this->render('sert');
    }

    public function actionApplication(){
        return $this->render('application');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionProfile(){
        $model=Employees::find()->where(['id'=>Yii::$app->user->identity->id])->one();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            if($model->validate()){
                $model->password=Yii::$app->security->generatePasswordHash($model->password);
                $model->save();
                Yii::$app->session->setFlash('success','Parol muvaffaqiyatli yangilandi');
                return $this->redirect('/cp/');
            }
        }
        $model->password='';
        return $this->render('/employees/profile',[
            'model'=>$model
        ]);
    }

}
