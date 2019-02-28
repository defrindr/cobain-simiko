<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSppSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-module-spp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'siswa_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->orderBy('user_id')->asArray()->all(), 'user_id', 'user_id'),
        'options' => ['placeholder' => 'Choose Module siswa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bank_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Module bank'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'bulan')->textInput(['maxlength' => true, 'placeholder' => 'Bulan']) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'placeholder' => 'Tahun']) ?>

    <?php /* echo $form->field($model, 'bukti_bayar')->textInput(['maxlength' => true, 'placeholder' => 'Bukti Bayar']) */ ?>

    <?php /* echo $form->field($model, 'spp')->textInput(['placeholder' => 'Spp']) */ ?>

    <?php /* echo $form->field($model, 'tabungan_prakerin')->textInput(['placeholder' => 'Tabungan Prakerin']) */ ?>

    <?php /* echo $form->field($model, 'tabungan_study_tour')->textInput(['placeholder' => 'Tabungan Study Tour']) */ ?>

    <?php /* echo $form->field($model, 'total')->textInput(['placeholder' => 'Total']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
