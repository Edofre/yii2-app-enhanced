<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\User as UserFixture;
use Yii;

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
		$I->amOnPage('/user/login');
		$I->fillField(Yii::t('user', 'Username'), 'admin');
		$I->fillField(Yii::t('user', 'Password'), 'password_0');
		$I->click('login-button');

		$I->see(Yii::t('user', 'Logout ({username})', ['username' => 'admin']), 'form button[type = submit]');
		$I->dontSeeLink(Yii::t('user', 'Login'));
		$I->dontSeeLink(Yii::t('user', 'Signup'));
	}
}
