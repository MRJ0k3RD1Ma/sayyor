<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'cp' => [
            'class' => 'app\modules\admin\Module',
        ],
        'komitet'=>[
            'class' => 'app\modules\komitet\Module',
        ],
        'region'=>[
            'class' => 'app\modules\region\Module',
        ],
        'district'=>[
            'class' => 'app\modules\district\Module',
        ]

    ],
//    'language'=>'uz',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'=>''
        ],
        'user' => [
            'identityClass' => 'common\models\Employees',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'uz',
                    'enableCaching' => true,
                    'cachingDuration' => 10,
                    'forceTranslation'=>true,
                    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']

                ],
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'sourceLanguage'=>'uz',
        'language'=>'uz',
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'class' => 'codemix\localeurls\UrlManager',
//            'languages' => ['uz', 'oz','ru'],
//            'enableDefaultLanguageUrlCode' => true,
//            'enableLanguagePersistence' => false,
            'rules' => [
                'komitet/<action>' => 'komitet/default/<action>',
                'region/<action>' => 'region/default/<action>',
                'district/<action>' => 'district/default/<action>',
            ],
        ],

    ],
    'params' => $params,
];
