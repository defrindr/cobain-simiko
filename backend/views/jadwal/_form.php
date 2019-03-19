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

            <?= $form->field($model, 'kode_guru')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $guru,
                'options' => ['placeholder' => 'Guru'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'jam_mulai')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJam::find()->orderBy('id')->asArray()->all(), 'id', 'jam'),
                'options' => ['placeholder' => 'Jam Mulai'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'jam_selesai')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJam::find()->orderBy('id')->asArray()->all(), 'id', 'jam'),
                'options' => ['placeholder' => 'Jam Selesai'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'hari')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $hari,
                'options' => ['placeholder' => 'Hari'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

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
