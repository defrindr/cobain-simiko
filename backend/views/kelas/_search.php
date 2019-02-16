<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-module-kelas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'jurusan_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJurusan::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Module jurusan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'guru_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleGuru::find()->orderBy('user_id')->asArray()->all(), 'user_id', 'user_id'),
        'options' => ['placeholder' => 'Choose Module guru'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'kelas')->textInput(['maxlength' => true, 'placeholder' => 'Kelas']) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true, 'placeholder' => 'Grade']) ?>

    <?php /* echo $form->field($model, 'tahun')->textInput(['maxlength' => true, 'placeholder' => 'Tahun']) */ ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Setel ulang', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
