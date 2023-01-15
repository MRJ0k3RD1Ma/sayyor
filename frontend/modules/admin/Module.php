<?php

namespace app\modules\admin;

use common\models\EmpPosts;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            $u = false;
                            if(Yii::$app->user->identity->empPosts->org->type_id == 4){
                                foreach (EmpPosts::find()->where(['state_id'=>1])->andWhere(['emp_id'=>Yii::$app->user->id])->all() as $item){
                                    if($item->post_id==5){
                                        $u = true; break;
                                    }
                                }
                                if($u){
                                    return $u;
                                }else{
                                    header('Location: '.Yii::$app->urlManager->createUrl(['/site/index']));
                                    exit;
                                }
                            }else{
                                header('Location: '.Yii::$app->urlManager->createUrl(['/site/index']));
                                exit;
                            }
                        }
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
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
//        \Yii::$app->layoutPath = "@app/modules/admin/views/layouts";
        // custom initialization code goes here
    }
}
