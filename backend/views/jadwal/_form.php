<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */
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

<div class="module-jadwal-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
            
        </div>
        <!-- end header box -->
        <div class="box-body">

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
                'options' => ['placeholder' => 'Mata Pelajaran'],
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

            <?= $form->field($model, 'jam_id')->label("Jam")->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJam::find()->orderBy('id')->asArray()->all(), 'id', 'jam'),
                'options' => ['placeholder' => 'Jam'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'hari')->textInput(['maxlength' => true, 'placeholder' => 'Hari']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
                    
        </div>
        <!-- end body box -->
    </div>



    <?php ActiveForm::end(); ?>

</div>
