<?php

namespace backend\controllers;

use backend\models\LoginForm;
use common\models\Users;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\rest\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actionLogin(){
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post(),'') and ($u = $model->login())){
            $user = Users::findOne($u);
            return [
                'status'=>200,
                'message'=>'Muvaffaqiyatli kirildi',
                'user_id'=>$user->id,
                'name'=>$user->name,
                'username'=>$user->username,
                'token'=>$user->token,
                'email'=>$user->email,
                'village_id'=>$user->post->village_id,
                'village_name'=>$user->post->village->name,
            ] ;
        }else{
            return $model;
        }
    }

}
