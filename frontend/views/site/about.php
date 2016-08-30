<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;

$this->title = Yii::t('site', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
	<h1><?= Html::encode($this->title) ?></h1>

	<p><?= Yii::t('site', 'This is the About page. You may modify the following file to customize its content:'); ?></p>

	<code><?= __FILE__ ?></code>
</div>
