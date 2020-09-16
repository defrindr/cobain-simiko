<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\slider\Slider;

$this->title = "Nilai dari ".$model->siswa->profile->nama;
?>
<div class="rubah-nilai-view">
	<iframe src="<?= Url::base()."/uploaded/materi-soal-jawaban/".$model->link ?>" frameborder="0" style="width: 100%;min-height: 500px;"></iframe>
	<br>
	<div class="container">
		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model,'nilai')->widget(Slider::classname(),[
			'pluginOptions' => [
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'tooltip' => 'always',
				'formatter'=>new yii\web\JsExpression("function(val) { 
						return val;
					}")
			]
		]); ?>
		<div class="form-group">
			<?= Html::submitButton('Submit Nilai',['class'=>'btn btn-success']) ?>
		</div>
	</div>
	<?php $form->end() ?>
</div>