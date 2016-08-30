<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;

/**
 * Class ContactForm
 * @package frontend\models
 *
 * ContactForm is the model behind the contact form.
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
	/** @var */
	public $verifyCode;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// name, email, subject and body are required
			[['name', 'email', 'subject', 'body'], 'required'],
			// email has to be a valid email address
			['email', 'email'],
			// verifyCode needs to be entered correctly
			['verifyCode', 'captcha'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'name'       => Yii::t('contact', 'Name'),
			'subject'    => Yii::t('contact', 'Subject'),
			'body'       => Yii::t('contact', 'Body'),
			'email'      => Yii::t('contact', 'Email'),
			'verifyCode' => Yii::t('contact', 'Verification Code'),
		]);
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
