<?php

namespace frontend\tests\functional;

use common\fixtures\User as UserFixture;
use frontend\tests\FunctionalTester;
use Yii;

class LoginCest
{
	function _before(FunctionalTester $I)
	{
		$I->haveFixtures([
			'user' => [
				'class'    => UserFixture::className(),
				'dataFile' => codecept_data_dir() . 'user.php',
			],
		]);
		$I->amOnRoute('user/login');
	}

	public function checkEmpty(FunctionalTester $I)
	{
		$I->submitForm('#login-form', $this->formParams('', ''));
		$I->seeValidationError(Yii::t('user', 'Username cannot be blank.'));
		$I->seeValidationError(Yii::t('user', 'Password cannot be blank.'));
	}

	protected function formParams($login, $password)
	{
		return [
			'LoginForm[username]' => $login,
			'LoginForm[password]' => $password,
		];
	}

	public function checkWrongPassword(FunctionalTester $I)
	{
		$I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
		$I->seeValidationError(Yii::t('user', 'Incorrect username or password.'));
	}

	public function checkValidLogin(FunctionalTester $I)
	{
		$I->submitForm('#login-form', $this->formParams('admin', 'password_0'));
		$I->see(Yii::t('user', 'Logout ({username})', ['username' => 'admin']), 'form button[type=submit]');
		$I->dontSeeLink(Yii::t('user', 'Login'));
		$I->dontSeeLink(Yii::t('user', 'Signup'));
	}
}
