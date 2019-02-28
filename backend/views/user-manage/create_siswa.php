<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="module-user-manage-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="container-fluid">
	<?= $form->errorSummary($model); ?>
		<?= $form->field($model,'nama')->textInput() ?>

		<?= $form->field($model, 'abstract')->label('Kelas')->widget(\kartik\widgets\Select2::classname(), [
			'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleKelas::find()->orderBy('id')->asArray()->all(), 'id', 'grade'),
			'options' => ['placeholder' => 'Choose Module kelas'],
			'pluginOptions' => [
			'allowClear' => true
			],
		]); ?>
		<?= $form->field($model,'username')->textInput() ?>
		<?= $form->field($model,'email')->textInput() ?>
		<?= $form->field($model,'password')->passwordInput() ?>
		<div class="form-group">
			<?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
</div>
