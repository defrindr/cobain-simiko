<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-module-siswa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'kelas_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleKelas::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Module kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Tanggal Lahir',
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?php /* echo $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) */ ?>

    <?php /* echo $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'No Telp']) */ ?>

    <?php /* echo $form->field($model, 'nama_wali')->textInput(['maxlength' => true, 'placeholder' => 'Nama Wali']) */ ?>

    <?php /* echo $form->field($model, 'no_telp_wali')->textInput(['maxlength' => true, 'placeholder' => 'No Telp Wali']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
