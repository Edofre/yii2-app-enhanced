<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<?php
NavBar::begin([
	'brandLabel' => 'My Company',
	'brandUrl'   => Yii::$app->homeUrl,
	'options'    => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
]);
$menuItems = [
	['label' => Yii::t('site', 'Home'), 'url' => ['/site/index']],
	['label' => Yii::t('site', 'About'), 'url' => ['/site/about']],
	['label' => Yii::t('site', 'Contact'), 'url' => ['/site/contact']],
];
if (Yii::$app->user->isGuest) {
	$menuItems[] = ['label' => Yii::t('user', 'Signup'), 'url' => ['/user/signup']];
	$menuItems[] = ['label' => Yii::t('user', 'Login'), 'url' => ['/user/login']];
} else {
	$menuItems[] = '<li>'
		. Html::beginForm(['/user/logout'], 'post')
		. Html::submitButton(
			Yii::t('user', 'Logout ({username})', ['username' => Yii::$app->user->identity->username]),
			['class' => 'btn btn-link']
		)
		. Html::endForm()
		. '</li>';
}

echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items'   => $menuItems,
]);
NavBar::end();