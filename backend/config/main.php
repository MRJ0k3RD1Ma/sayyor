<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'enableSession'=>false,
            'loginUrl'=>null,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    $response->statusCode = 200;
                }
            },
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'auth'=>'site/login',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'report',
                    'extraPatterns' => [
                        'GET getregion' => 'getregion',
                        'GET getdistrict'=>'getdistrict',
                        'GET get-vet'=>'get-vet',
                        'GET getcategory'=>'getcategory',
                        'GET gettype'=>'gettype',
                        'POST create'=>'create',
                        'POST setimage'=>'setimage',
                        'POST createfood'=>'createfood',
                        'GET getqfi'=>'getqfi',
                        'GET getfoodtype'=>'getfoodtype',
                        'GET getfoodcategory'=>'getfoodcategory',
                        'GET getdrugtype'=>'getdrugtype',
                        'POST createdrug'=>'createdrug',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'petition',
                    'extraPatterns' => [
                        'GET getorg'=>'getorg',
                        'POST create'=>'create',
                    ],
                ],
            ],
        ]

    ],
    'params' => $params,
];
