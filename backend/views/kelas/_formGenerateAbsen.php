<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

$now = date('Y',time());
$tahun = [];
foreach (range($now-3,$now+3) as $key => $value) {
	$tahun += [$value=>$value];
}

$list_bulan = array(
    "Januari" => "Januari",
    "Februari" => "Februari",
    "Maret" => "Maret",
    "April" => "April",
    "Mei" => "Mei",
    "Juni" => "Juni",
    "Juli" => "Juli",
    "Agustus" => "Agustus",
    "September" => "September",
    "Oktober" => "Oktober",
    "November" => "November",
    "Desember" => "Desember"
);
?>
<div class="module-kelas-form-absen">
	<?php $form = ActiveForm::begin([]); ?>
	<div class="container-fluid">
		<?= $form->field($model,'tahun')->widget(Select2::classname(),
			[
				'data' => $tahun,
				'options' => ['placeholder' => 'Tahun'],
				'pluginOptions' => [
					'allowClear' => true
				],
			]
		) ?>
		<?= $form->field($model,'bulan')->widget(Select2::classname(),[
				'data' => $list_bulan,
				'options' => ['placeholder' => 'Bulan'],
				'pluginOptions' => [
					'allowClear' => true
				],
		]) ?>
		<div class="form-group">
			<?= Html::submitButton('Create Absensi', ['class' =>'btn btn-success']) ?>
			<?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
		</div>
	</div>
	<?php ActiveForm::end() ?>
</div>