<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\ActiveForm;

$this->title = "Nilai dari ".$model->siswa->profile->nama;
?>
<div class="rubah-nilai-view">
	<iframe src="<?= Url::base()."/uploaded/materi-soal-jawaban/".$model->link ?>" frameborder="0" style="width: 100%;min-height: 500px;"></iframe>
	<div class="container">
		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model,'nilai')->
	</div>
</div>