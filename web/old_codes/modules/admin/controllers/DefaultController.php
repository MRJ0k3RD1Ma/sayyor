<?php

namespace app\modules\admin\controllers;

use app\models\Admin;
use app\models\AdminForm;
use app\models\District;
use app\models\DistrictOld;
use app\models\LoginForm;
use app\models\Minestory;
use app\models\Tashkilot;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['logout'],
                'user'=>'admin',
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['/admin/default/login','create'],
                        'allow' => true,
                        'roles' => ['?'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->admin->isGuest){
           return $this->redirect(['login']);
        }
        return $this->render('index');
    }


    public function actionLogin()
    {

        if (!Yii::$app->admin->isGuest) {
            return $this->goHome();
        }
        $this->layout = "login.php";
        $model = new AdminForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->admin->logout();

        return $this->redirect('login');
    }


    public function actionCreate(){
        $model = new Admin();
        if($model->load(Yii::$app->request->post())){
            $model->share = 1;
            $model->encrypt();
            $model->save();
        }
        return $this->redirect(['login']);
    }


    public function actionProfile(){
        $model = Admin::findOne(Yii::$app->admin->getId());
        $pas = $model->password;
        $model->password = "";
        if ($model->load(Yii::$app->request->post())) {
            if(strlen($model->password)>0){
                $model->encrypt(false);
            }else{
                $model->password = $pas;
            }
            $model->save();

            return $this->redirect(['profile']);
        } else {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
    }







    /*public function actionPro(){
        $model =  DistrictOld::find()->all();

        foreach ($model as $item){

                $m = new District();
                $m->code = GenerateRandomUnicalString(District::find());
                $m->name = $item->Name;
                $m->region_id = $item->id_region;
                $m->country_id = 1;
                if($m->save()){
                    echo "<p style='color:#fff; background:gray'>{$m->name}</p>";
                }else{
                    echo "<p style='color:#fff; background:darkred'>{$m->name}</p>";
                }

                echo "<br><br>";
                $m = null;

        }
    }*/
}
