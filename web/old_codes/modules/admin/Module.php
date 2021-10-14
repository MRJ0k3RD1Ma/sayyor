<?php

namespace app\modules\admin;
use yii\filters\AccessControl;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */

//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['/admin/default/login'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//                'denyCallback' => function($rule, $action) {
//                    return \Yii::$app->response->redirect(['/admin/default/login']);
//                },
//            ],
//        ];
//    }

    public function init()
    {

        parent::init();
//        \Yii::configure($this, require __DIR__ . '/../../config/webadmin.php');
        \Yii::$app->viewPath = "@app/modules/admin/views";
        \Yii::$app->set('admin', [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
            'loginUrl' => ['admin/default/login'],
        ]);

        // custom initialization code goes here
    }
}
