<?php

$params = require(__DIR__ . '/params.php');

$modules = ['admin'];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'rus-RUS',
    'sourceLanguage' => 'en',
    'timezone' => 'Europe/Moscow',
    'bootstrap' => ['log'],
    'components' => [
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bmEbEFRNnngl',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => ['login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'app\components\ModuleUrlRule', 'appModules' => $modules],
            ],
//            'rules' => [
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>/<id:\d+>/<params:\w+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
//                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
//                'login' => 'login/index'
//            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache' //Включаем кеширование
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'@web',
                'basePath'=>'@webroot',
                'path' => 'images/blog/articles',
                'name' => 'articles'
            ],
//            'watermark' => [
//                'source'         => __DIR__.'/logo.png', // Path to Water mark image
//                'marginRight'    => 5,          // Margin right pixel
//                'marginBottom'   => 5,          // Margin bottom pixel
//                'quality'        => 95,         // JPEG image save quality
//                'transparency'   => 70,         // Water mark image transparency ( other than PNG )
//                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
//                'targetMinPixel' => 200         // Target image minimum pixel size
//            ]
        ]
    ],
    'modules' => [
//        'user' => [
//            'class' => 'amnah\yii2\user\Module',
//        ],
        'admin' => [
            'class' => 'app\modules\AdminModule',
            'as access' => [ // if you need to set access
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'], // all auth users

                    ],
                ]
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
