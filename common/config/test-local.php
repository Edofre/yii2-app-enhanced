<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
        'id'         => 'common',
        'basePath'   => dirname(__DIR__),
        'language'   => 'nl-NL',
        'components' => [
            'user' => [
                'class'         => 'yii\web\User',
                'identityClass' => 'common\models\User',
            ],
            'db'   => [
                'dsn' => 'mysql:host=localhost;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=yii2_enhanced_test',
            ],
        ],
    ]
);