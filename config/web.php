<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language' => 'ru-RU',
    'id' => 'basic',
    'name' => 'ППТК',
    'basePath' => dirname(__DIR__),
    'timeZone' => 'Europe/Moscow',
    'bootstrap' => [
        'log',
        'app\bootstrap\Bootstrap'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'thumbnail' => [
            'class' => 'sadovojav\image\Thumbnail',
            'cachePath' => '@webroot/thumbnails',
            'prefixPath' => '@web',
            'cacheExpire' => '604800',
            'options' => [
                'placeholder' => [
                    'type' => sadovojav\image\Thumbnail::PLACEHOLDER_TYPE_IMAGINE,
                    'textSize' => 30,
                    'text' => 'Нет изображения'
                ],
                'quality' => 100,
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'u2clGUQ4uS7Bx5a-2P0aQYpApoWCxmq_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\user\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/auth/sign-in'],
        ],
        'errorHandler' => [
            'errorAction' => 'app/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.beget.com',
                'username' => 'support@pptk-lnr.ru',  // адрес почты (отправитель)
                'password' => 'MK6n3f%v',           // пароль почты
                'port' => '465',
                'encryption' => 'ssl'
            ],
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ""=>"info/main",
                '/delivery' => '/info/delivery',
                '/payment' => '/info/payment',
                '/about' => '/info/about',
                '/contact' => '/info/contact',
                '/news' => '/info/news',
                '/producers' => '/info/producers',
                '/terms' => '/info/terms',

                '/sign-in' => '/auth/sign-in',
                '/sign-up' => '/auth/sign-up',
                '/logout' => '/auth/logout',
                '/recover' => '/auth/recover',

                '/stock' => '/catalog/stock',
                //'/category/<id:\d+>' => '/catalog/category',
                '/product/<id:\d+>' => '/catalog/view',


                '/cart' => '/cart/index',
                '/checkout' => '/cart/checkout',

                '/profile' => '/user/profile',
                '/wish-list' => '/user/wish-list',
                '/status' => '/user/status',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '127.0.0.1:9200'],
                // configure more hosts if you have a cluster
            ],
        ],

        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=9306;',
            'username' => '',
            'password' => '',
        ],



    ],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Admin',
            'layout' => '@app/modules/admin/views/layouts/main.php',
            'modules' => [
                'rbac' => [
                    'class' => 'mdm\admin\Module',
                    'controllerMap' => [
                        'assignment' => [
                            'class' => 'mdm\admin\controllers\AssignmentController',
                            'userClassName' => 'app\models\user\User',
                            'idField' => 'id',
                            'usernameField' => 'username',
                        ],
                    ],
                    'menus' => [
                        'user' => null,
                        'rule' => null,
                    ],
                ]
            ],

        ],
        /*'yii2images' => [
                'class' => 'rico\yii2images\Module',
                //be sure, that permissions ok
                //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
                'imagesStorePath' => 'uploads/imagesStore', //path to origin images
                'imagesCachePath' => 'uploads/imagesCache', //path to resized copies
                'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
                'placeHolderPath' => '@web/img/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],*/
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*'
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
