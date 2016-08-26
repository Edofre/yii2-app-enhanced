<?php
namespace tests\frontend\acceptance;

use frontend\tests\AcceptanceTester;
use Yii;
use yii\helpers\Url;

/**
 * Class HomeCest
 * @package tests\frontend\acceptance
 */
class HomeCest
{
	public function checkHome(AcceptanceTester $I)
	{
		$I->amOnUrl('http://enhanced-front.nl');
		$I->amOnPage(Url::toRoute('/site/home'));
		$I->see('My Company');
		$I->seeLink('About');
		$I->click('About');
		$I->see('This is the About page.');
	}
}