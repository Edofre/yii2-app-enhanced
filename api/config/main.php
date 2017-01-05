<?php

Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'         => 'app-api',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'modules'    => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class'    => 'api\modules\v1\Module' // here is our v1 module
        ],
    ],
    'components' => [
        'session'    => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'user'       => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl'      => null,
        ],
        'response'   => [
            'format'  => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'request'    => [
            'class'                  => '\yii\web\Request',
            'enableCookieValidation' => false,
            'csrfParam'              => '_csrf-api',
            'parsers'                => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => true,
            'showScriptName'      => false,
            'rules'               => [
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => 'v1/user',
                    'pluralize'     => false,
                    'only'          => [
                        'login',
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                    ],
                ],
                [
                    'class'         => 'yii\rest\UrlRule',
                    'controller'    => 'v1/contact',
                    'pluralize'     => false,
                    'only'          => [
                        'message',
                    ],
                    'extraPatterns' => [
                        'POST message' => 'message',
                    ],
                ],
            ],
        ],
    ],
    'params'     => $params,
];
