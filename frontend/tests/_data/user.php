<?php

return [
	[
		'id'                   => 1,
		'username'             => 'admin',
		'auth_key'             => '1Uu1qHcde0diwUol3xeI-18MuHkkprQI',
		'password_hash'        => '$2y$13$nJ1WDlBaGcbCdbNC5.5l4.sgy.OMEKCqtDQOdQ2OWpgiKRWYyzzne', // password_0
		'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
		'last_login'           => time(),
		'created_at'           => time(),
		'updated_at'           => time(),
		'email'                => 'admin@test.com',
	],
	[
		'id'                   => 2,
		'username'             => 'member',
		'auth_key'             => '2Uu1qHcde0diwUol3xeI-18MuHkkprQI',
		'password_hash'        => '$2y$13$nJ1WDlBaGcbCdbNC5.5l4.sgy.OMEKCqtDQOdQ2OWpgiKRWYyzzne', // password_0
		'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
		'last_login'           => time(),
		'created_at'           => time(),
		'updated_at'           => time(),
		'email'                => 'member@test.com',
	],
];