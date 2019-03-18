<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;


$this->title = "Ganti Password";
?>

<div class="site-ganti-password">
	<div class="container-fluid">
		<div class="box box-success">
			<div class="box-header">
				<?php $form = ActiveForm::begin(['id'=>'change-password-form']); ?>
				
			</div>
			<div class="box-body">
				<?= $form->field($model,'new_pass')->passwordInput() ?>

				<?= $form->field($model,'new_pass_repeat')->passwordInput() ?>

				<?= $form->field($model,'old_pass')->passwordInput() ?>

				<?= $form->field($model, 'captVe')->widget(Captcha::className(), [
					'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
				]) ?>
				<div class="form-group">
					<?= Html::submitButton('Ubah Password',['name' => 'ganti-password-button','class' => 'btn btn-primary']) ?>
				</div>
				
			</div>
		</div>

		<?php ActiveForm::end() ?>
	</div>
</div>