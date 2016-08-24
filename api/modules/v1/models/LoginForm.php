<?php
namespace api\modules\v1\models;

use Yii;

/**
 * Class LoginForm
 * @package api\modules\v1\models
 */
class LoginForm extends \yii\base\Model
{
	/** @var String The user's username */
	public $username;
	/** @var String The user's password */
	public $password;
	/** @var bool */
	private $_user = false;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['username', 'password'], 'required'], // username and password are both required
			['password', 'validatePassword'], // password is validated by validatePassword()
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'username' => Yii::t('user', 'Username'),
			'password' => Yii::t('user', 'Password'),
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array  $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Yii::t('user', 'Incorrect username or password.'));
			}
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByUsername($this->username);
		}

		return $this->_user;
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			// Update the last login time for this user
			$this->getUser()->last_login = time();
			$this->getUser()->save();
			return Yii::$app->user->login($this->getUser());
		}

		return false;
	}
}
