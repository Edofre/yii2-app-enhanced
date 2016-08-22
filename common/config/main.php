<?php
return [
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache'      => [
			'class' => 'yii\caching\FileCache',
		],
		'i18n'       => [
			'translations' => [
				'*' => [
					'basePath'              => '@common/messages',
					'class'                 => 'yii\i18n\PhpMessageSource',
					'on missingTranslation' => ['common\components\i18n\TranslationEventHandler', 'handleMissingTranslation'],
				],
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
		],
	],
];
