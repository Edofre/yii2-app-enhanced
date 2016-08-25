<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;

/**
 * Class ContactForm
 * @package api\modules\v1\models
 */
class ContactForm extends Model
{
	/** @var */
	public $name;
	/** @var */
	public $email;
	/** @var */
	public $subject;
	/** @var */
	public $body;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'email', 'subject', 'body'], 'required'], // name, email, subject and body are required
			['email', 'email'], // email has to be a valid email address
		];
	}

	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 *
	 * @param string $email the target email address
	 * @return boolean whether the email was sent
	 */
	public function sendEmail($email)
	{
		return Yii::$app->mailer->compose()
			->setTo($email)
			->setFrom([$this->email => $this->name])
			->setSubject($this->subject)
			->setTextBody($this->body)
			->send();
	}
}
