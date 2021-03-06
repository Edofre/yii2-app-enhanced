<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\forms\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::t('user', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-request-password-reset">
	<h1><?= Html::encode($this->title) ?></h1>

	<p><?= Yii::t('user', 'Please fill out your email. A link to reset password will be sent there.'); ?></p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'request-password-form']); ?>

			<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

			<div class="form-group">
				<?= Html::submitButton(Yii::t('common', 'Send'), ['class' => 'btn btn-primary']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
