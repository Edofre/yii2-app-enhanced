<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use Yii;

class HomeCest
{
	public function checkOpen(FunctionalTester $I)
	{
		$I->amOnPage(\Yii::$app->homeUrl);
		$I->see('My Company');
		$I->seeLink(Yii::t('site', 'About'));
		$I->click(Yii::t('site', 'About'));
		$I->see(Yii::t('site', 'This is the About page. You may modify the following file to customize its content:'));
	}
}