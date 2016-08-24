<?php

namespace api\modules\v1;

use yii\filters\auth\HttpBasicAuth;

/**
 * Class Module
 * @package api\modules\v1
 */
class Module extends \yii\base\Module
{
	/** @var string */
	public $controllerNamespace = 'api\modules\v1\controllers';
	/** @var string */
	public $modelNamespace = 'api\modules\v1\models';

	/**
	 *
	 */
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false; // Disable the user session
	}

	/**
	 * @return array
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();

		// Add the authenticator for all controllers except user
		if (\Yii::$app->controller->id !== 'user') {
			$behaviors['authenticator'] = [
				'class' => HttpBasicAuth::className(),
			];
		}
		return $behaviors;
	}
}
