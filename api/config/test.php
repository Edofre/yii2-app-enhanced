<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', __DIR__.'/../../');

$config = yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/test.php'),
    require(YII_APP_BASE_PATH . '/common/config/test-local.php'),
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    [
        'id' => 'api-tests',
    ]
);

return $config;