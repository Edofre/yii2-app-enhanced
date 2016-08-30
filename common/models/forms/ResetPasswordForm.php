<?php
namespace common\models\forms;

use common\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;

/**
 * Class ResetPasswordForm
 * @package common\models\forms
 */
class ResetPasswordForm extends Model
{
	/** @var */
	public $password;
	/** @var \common\models\User */
	private $_user;

	/**
	 * Creates a form model given a token.
	 *
	 * @param string $token
	 * @param array  $config name-value pairs that will be used to initialize the object properties
	 * @throws \yii\base\InvalidParamException if token is empty or not valid
	 */
	public function __construct($token, $config = [])
	{
		if (empty($token) || !is_string($token)) {
			throw new InvalidParamException(Yii::t('user', 'Password reset token cannot be blank.'));
		}
		$this->_user = User::findByPasswordResetToken($token);
		if (!$this->_user) {
			throw new InvalidParamException(Yii::t('user', 'Wrong password reset token.'));
		}
		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}

	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'password' => Yii::t('user', 'Password'),
		]);
	}

	/**
	 * Resets password.
	 *
	 * @return boolean if password was reset.
	 */
	public function resetPassword()
	{
		$user = $this->_user;
		$user->setPassword($this->password);
		$user->removePasswordResetToken();

		return $user->save(false);
	}
}
