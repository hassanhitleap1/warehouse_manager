<?php

$aliases = require __DIR__ . '/aliases.php';
$db = require __DIR__ . '/db.php';
$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'baseic',
    'language' => 'ar',
    'name'=>$params['name_of_store'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => $aliases,
    'components' => [
        'cart' => [
            'class' => 'devanych\cart\Cart',
            'storageClass' => 'devanych\cart\storage\SessionStorage',
            'calculatorClass' => 'devanych\cart\calculators\SimpleCalculator',
            'params' => [
                'key' => 'cart',
                'expire' => 604800,
                'productClass' => 'app\models\products\Products',
                'productFieldId' => 'id',
                'productFieldPrice' => 'selling_price',
            ],
        ],

        'favorite' => [
            'class' => 'devanych\cart\Cart',
            'storageClass' => 'devanych\cart\storage\DbSessionStorage',
            'calculatorClass' => 'devanych\cart\calculators\SimpleCalculator',
            'params' => [
                'key' => 'favorite',
                'expire' => 604800,
                'productClass' => 'app\models\products\Products',
                'productFieldId' => 'id',
                'productFieldPrice' => 'selling_price',
            ],
        ],

        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'pusher' => [
            'class' => 'br0sk\pusher\Pusher',
            /*
             * Mandatory parameters.
             */
            'appId' => 'YOUR_APP_ID',
            'appKey' => 'YOUR_APP_KEY',
            'appSecret' => 'YOUR_APP_SECRET',
            /*
             * Optional parameters.
             */
            'options' => ['encrypted' => true, 'cluster' => 'YOUR_APP_CLUSTER']
        ],
//         'urlManager' => [
//             'enablePrettyUrl' => true,
//             'showScriptName' => false,
//             'enableStrictParsing' => false,
//             'rules' => [
//                     'posts/<year:\d{4}>/<category>' => 'post/index',
//                     'posts' => 'post/index',
//                     'post/<id:\d+>' => 'post/view',

// //                    'posts' => 'post/index',
// //                    'post/<id:\d+>' => 'post/view',


//             ],
//         ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'IjRtIuj8nnX773QduboRRd1VXr8KkSic',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        'dynagrid' =>  [
            'class' => '\kartik\dynagrid\Module',
            // other settings (refer documentation)
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ]
   ] ,
    'params' => $params

];

if (YII_ENV_DEV) { // YII_ENV_DEV YII_ENV_PROD
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
