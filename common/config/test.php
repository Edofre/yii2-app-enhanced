<?php
return yii\helpers\ArrayHelper::merge(
	require(__DIR__ . '/main.php'),
	require(__DIR__ . '/main-local.php'),
	[
		'components' => [
			'db' => [
				'dsn' => 'mysql:host=localhost;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=yii2_enhanced_test',
			],
		],
	]
);