<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class AboutCest
{
	public function checkAbout(FunctionalTester $I)
	{
		$I->amOnRoute('site/about');
		$I->see(Yii::t('site', 'About'), 'h1');
	}
}
