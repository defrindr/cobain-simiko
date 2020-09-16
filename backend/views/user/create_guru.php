<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="module-user-manage-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="container-fluid">
	<?= $form->errorSummary($model); ?>
		<?= $form->field($model,'nama')->textInput() ?>

		<?= $form->field($model, 'abstract')->label('Mata Pelajaran')->widget(\kartik\widgets\Select2::classname(), [
			'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->orderBy('id')->asArray()->all(), 'id', 'nama_mapel'),
			'options' => ['placeholder' => 'Mata pelajaran'],
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
