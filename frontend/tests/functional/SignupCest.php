<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class SignupCest
{
	protected $formId = '#form-signup';

	public function _before(FunctionalTester $I)
	{
		$I->amOnRoute('user/signup');
	}

	public function signupWithEmptyFields(FunctionalTester $I)
	{
		$I->see(Yii::t('user', 'Signup'), 'h1');
		$I->see(Yii::t('user', 'Please fill out the following fields to signup:'));
		$I->submitForm($this->formId, []);
		$I->seeValidationError(Yii::t('user', 'Username cannot be blank.'));
		$I->seeValidationError(Yii::t('user', 'Email cannot be blank.'));
		$I->seeValidationError(Yii::t('user', 'Password cannot be blank.'));

	}

	public function signupWithWrongEmail(FunctionalTester $I)
	{
		$I->submitForm(
			$this->formId, [
				'SignupForm[username]' => 'tester',
				'SignupForm[email]'    => 'ttttt',
				'SignupForm[password]' => 'tester_password',
			]
		);
		$I->dontSee(Yii::t('user', 'Username cannot be blank.'), '.help-block');
		$I->dontSee(Yii::t('user', 'Password cannot be blank.'), '.help-block');
		$I->see(Yii::t('user', 'Email is not a valid email address.'), '.help-block');
	}

	public function signupSuccessfully(FunctionalTester $I)
	{
		$I->submitForm($this->formId, [
			'SignupForm[username]' => 'tester',
			'SignupForm[email]'    => 'tester.email@example.com',
			'SignupForm[password]' => 'tester_password',
		]);

		$I->seeRecord('common\models\User', [
			'username' => 'tester',
			'email'    => 'tester.email@example.com',
		]);

		$I->see(Yii::t('user', 'Logout ({username})', ['username' => 'tester']), 'form button[type=submit]');
	}
}
