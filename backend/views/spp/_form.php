<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */
/* @var $form yii\widgets\ActiveForm */

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

<div class="module-spp-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <!-- end header box -->
        <div class="box-body">

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'siswa_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->innerJoinWith(['profile'])->orderBy('profile.nama')->asArray()->all(), 'user_id', 'profile.nama'),
                'options' => ['placeholder' => 'Nama Siswa'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'bank_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->orderBy('nama_bank')->asArray()->all(), 'id', 'nama_bank'),
                'options' => ['placeholder' => 'Nama Bank'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'bulan')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_bulan,
                'options' => ['placeholder'=>'Pilih Bulan'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'placeholder' => 'Tahun']) ?>

            <?= $form->field($model, 'bukti_bayar')->textInput(['maxlength' => true, 'placeholder' => 'Bukti Bayar']) ?>

            <?= $form->field($model, 'spp')->textInput(['placeholder' => 'Spp']) ?>

            <?= $form->field($model, 'tabungan_prakerin')->textInput(['placeholder' => 'Tabungan Prakerin']) ?>

            <?= $form->field($model, 'tabungan_study_tour')->textInput(['placeholder' => 'Tabungan Study Tour']) ?>

            <?php // $form->field($model, 'total')->textInput(['placeholder' => 'Total']) ?>

            <?php // $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

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
