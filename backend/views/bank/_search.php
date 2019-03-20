<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBankSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-module-bank-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'no_rekening')->textInput(['maxlength' => true, 'placeholder' => 'No Rekening']) ?>

    <?= $form->field($model, 'nama_bank')->textInput(['maxlength' => true, 'placeholder' => 'Nama Bank']) ?>

    <?= $form->field($model, 'atas_nama')->textInput(['maxlength' => true, 'placeholder' => 'Atas Nama']) ?>

    <?php //echo $form->field($model, 'gambar')->textInput(['maxlength' => true, 'placeholder' => 'Gambar']) ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
