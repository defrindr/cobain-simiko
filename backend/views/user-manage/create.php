<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="module-user-manage-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="container-fluid">
	<?= $form->errorSummary($model); ?>
		<?= $form->field($model,'nama')->textInput() ?>
		<?= $form->field($model,'username')->textInput() ?>
		<?= $form->field($model,'email')->textInput() ?>
		<?= $form->field($model,'password')->textInput() ?>
		<div class="form-group">
			<?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>
