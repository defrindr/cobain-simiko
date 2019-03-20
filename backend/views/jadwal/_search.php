<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwalSearch */
/* @var $form yii\widgets\ActiveForm */
$hari = [
    "Senin" => "Senin",
    "Selasa" => "Selasa",
    "Rabu" => "Rabu",
    "Kamis" => "Kamis",
    "Jum'at" => "Jum'at",
    "Sabtu" => "Sabtu",
];

$GuruAll = \common\models\ModuleGuru::find()->orderBy('id')->all();
$guru = [];
$kelasAll = \common\models\ModuleKelas::find()->orderBy('id')->all();
$kelas = [];
foreach ($GuruAll as $each) {
    $guru += [$each->id => $each->profile->nama];
}
foreach ($kelasAll as $each) {
    $kelas += [$each->id => $each->grade . " " . " " . $each->jurusan->nama . " " . $each->kelas];
}

// echo "<pre>";
// print_r($kelas);
// exit();

$jam = [
    "07.00" => "07.00",
    "07.40" => "07.40",
    "08.20" => "08.20",
    "09.00" => "09.00",
    "09.40" => "09.40",
    "10.20" => "10.20",
    "11.00" => "11.00",
    "11.40" => "11.40",
    "12.20" => "12.20",
    "13.00" => "13.00",
    "13.40" => "13.40",
    "14.20" => "14.20",
    "15.00" => "15.00"
];
?>

<div class="form-module-jadwal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'kelas_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => $kelas,
        'options' => ['placeholder' => 'Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'mapel_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->orderBy('id')->asArray()->all(), 'id', 'nama_mapel'),
        'options' => ['placeholder' => 'Mata pelajaran'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'kode_guru')->widget(\kartik\widgets\Select2::classname(), [
        'data' => $guru,
        'options' => ['placeholder' => 'Guru'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'jam_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJam::find()->orderBy('id')->asArray()->all(), 'id', 'jam'),
        'options' => ['placeholder' => 'Jam'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'hari')->textInput(['maxlength' => true, 'placeholder' => 'Hari']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
