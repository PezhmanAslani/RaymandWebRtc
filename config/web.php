<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pNG1MTj1-_ApEmX_ER--9wRb5fFW0V-I',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users\TblUsers',
            'enableAutoLogin' => false,
            'enableSession' => true,
            'loginUrl' => null
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 'controller' => 'user',
                    'extraPatterns' => [
                        'login' => 'login',
                    ]
                ],
                 [
                     'class' => 'yii\rest\UrlRule', 'controller' => 'contact',
                 ],
                [
                    'class'=>'yii\rest\UrlRule','controller'=>'history'
                ]
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'variable'],
                // [
                //     'class' => 'yii\rest\UrlRule', 'controller' => 'sip-profile',
                //     'extraPatterns' => [
                //         'GET get-profiles' => 'get-profiles',
                //         'OPTIONS get-profiles' => 'options',
                //     ]
                // ],
                // [
                //     'class' => 'yii\rest\UrlRule', 'controller' => 'sip-trunk',
                //     'extraPatterns' => []
                // ],
                // [
                //     'class' => 'yii\rest\UrlRule', 'controller' => 'sip-user-group',
                //     'extraPatterns' => [
                //         'GET get-sip-Groups' => 'get-sip-groups',
                //         'OPTIONS get-sip-groups' => 'options',
                //     ]
                // ],
                // [
                //     'class' => 'yii\rest\UrlRule', 'controller' => 'sip-user',
                //     'extraPatterns' => [
                //         'GET get-sip-user-options' => 'get-sip-user-options',
                //         'OPTIONS get-sip-user-options' => 'options',
                //     ]
                // ],

            ],
        ],
        'jwt' => [
            'class' => \bizley\jwt\Jwt::class,
            'signer' => \bizley\jwt\Jwt::HS256,
            'signingKey' => "JYET#8635e3^%E73te873dsffddsfsdfsdf7e37e8",
        ],
        
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
