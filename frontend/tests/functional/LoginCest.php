<?php

namespace frontend\tests\functional;

use common\fixtures\User as UserFixture;
use frontend\tests\FunctionalTester;

class LoginCest
{
	function _before(FunctionalTester $I)
	{
		$I->haveFixtures([
			'user' => [
				'class'    => UserFixture::className(),
				'dataFile' => codecept_data_dir() . 'login_data.php',
			],
		]);
		$I->amOnRoute('site/login');
	}

	public function checkEmpty(FunctionalTester $I)
	{
		$I->submitForm('#login-form', $this->formParams('', ''));
		$I->seeValidationError('Username cannot be blank.');
		$I->seeValidationError('Password cannot be blank.');
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
		$I->seeValidationError('Incorrect username or password.');
	}

	public function checkValidLogin(FunctionalTester $I)
	{
		$I->submitForm('#login-form', $this->formParams('admin', 'password_0'));
		$I->see('Logout (admin)', 'form button[type=submit]');
		$I->dontSeeLink('Login');
		$I->dontSeeLink('Signup');
	}
}
