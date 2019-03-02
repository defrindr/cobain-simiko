<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$list_kelas = [];

$modelKelas = \common\models\ModuleKelas::find()->orderBy('id')->all();
foreach ($modelKelas as $kelas) {
    $list_kelas += [$kelas->id=>$kelas->grade." ".$kelas->jurusan->nama." ".$kelas->kelas];
}
?>

<div class="module-user-manage-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="container-fluid">
	<?= $form->errorSummary($model); ?>
		<?= $form->field($model,'nama')->textInput() ?>

		<?= $form->field($model, 'abstract')->label('Kelas')->widget(\kartik\widgets\Select2::classname(), [
			'data' => $list_kelas,
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
