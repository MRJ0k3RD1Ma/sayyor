<?php

namespace app\modules\region;

use common\models\EmpPosts;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
/**
 * komitet module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\region\controllers';
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
                            if(Yii::$app->user->identity->empPosts->org->type_id == 3){
                               return true;
                            }else{
                                header('Location: '.Yii::$app->urlManager->createUrl(['/site/index']));
                                exit;
                            }
                        }
                    ],
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
//        \Yii::$app->layoutPath = "@app/modules/region/views/layouts";

        // custom initialization code goes here
    }
}
