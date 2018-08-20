<?php

$params = require(__DIR__ . '/params.php');

$modules = ['admin'];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'rus-RUS',
    'sourceLanguage' => 'en',
    'timezone' => 'UTC',
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => ['/js/jquery-2.1.4.min.js'] // тут путь до Вашего экземпляра jquery
                ],
            ],
//            'linkAssets' => true,
//            'forceCopy' => true
        ],
        'frontCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache'
        ],
        'system' => [
            'class' => 'app\components\SystemComponent'
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bmEbEFRNnngl',
            'baseUrl' => ''
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
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['info@san-kras.ru' => 'SanKras'],
            ],
            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
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
            'enableStrictParsing' => false,
            'rules' => [
                '<module:(admin)>' => 'admin/admin/index',
                '<module:(admin)>/<controller>' => 'admin/<controller>/index',
                '<module:(admin)>/<controller>/<action>' => 'admin/<controller>/<action>',
                '<action:(flat|house|company|contacts|privacy-policy|login)>' => 'site/<action>',
                '<controller:(prices|works|about)>' => '<controller>/index',
                '<controller:(prices|works|about|site|page|elfinder)>/<action>' => '<controller>/<action>',
                '<action:.+>/<key:.+>' => 'page/index',
                '<key:.+>' => 'page/index',
                '<controller:(about)>/<action:(news|articles)><id:\d+>' => '<controller>/<action>',
            ],
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
                'path' => '/images/blog/news/upload',
                'name' => 'upload'
            ],
        ],
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
