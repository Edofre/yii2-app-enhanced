<?php
namespace api\modules\v1\controllers;

use api\modules\v1\components\V1RestController;
use api\modules\v1\models\ContactForm;
use Yii;

/**
 * Class ContactController
 * @package api\modules\v1\controllers
 */
class ContactController extends V1RestController
{
	/**
	 * Enables the user to contact us.
	 * User has to be logged in
	 * @return ContactForm|string
	 */
	public function actionMessage()
	{
		$model = new ContactForm();
		if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				return 'Thank you for contacting us. We will respond to you as soon as possible.';
			} else {
				return 'There was an error sending email.';
			}
		}
		return $model;
	}
}
