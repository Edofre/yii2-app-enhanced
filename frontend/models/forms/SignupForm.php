<?php
namespace frontend\models\forms;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Class SignupForm
 * @package frontend\models
 */
class SignupForm extends Model
{
	/** @var */
	public $username;
	/** @var */
	public $email;
	/** @var */
	public $password;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['username', 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('user', 'This username has already been taken.')],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('user', 'This email address has already been taken.')],

			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'username' => Yii::t('user', 'Username'),
			'email'    => Yii::t('user', 'Email'),
			'password' => Yii::t('user', 'Password'),
		]);
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		if (!$this->validate()) {
			return null;
		}

		$user = new User();
		$user->username = $this->username;
		$user->email = $this->email;
		$user->setPassword($this->password);
		$user->generateAuthKey();

		return $user->save() ? $user : null;
	}
}
