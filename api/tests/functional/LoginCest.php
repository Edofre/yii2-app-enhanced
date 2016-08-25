<?php

namespace api\tests\functional;

use api\tests\FunctionalTester;
use common\fixtures\User as UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
	public function _before(FunctionalTester $I)
	{
		$I->haveFixtures([
			'user' => [
				'class'    => UserFixture::className(),
				'dataFile' => codecept_data_dir() . 'login_data.php',
			],
		]);
	}

	/**
	 * @param FunctionalTester $I
	 */
	public function loginUser(FunctionalTester $I)
	{
		// TODO API
//		$I->amOnPage('/site/login');
//		$I->fillField('Username', 'admin');
//		$I->fillField('Password', 'password_0');
//		$I->click('login-button');
//
//		$I->see('Logout (admin)', 'form button[type=submit]');
//		$I->dontSeeLink('Login');
//		$I->dontSeeLink('Signup');
	}
}
