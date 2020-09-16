<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-mata-pelajaran-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->errorSummary($model); ?>
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'nama_mapel')->textInput(['maxlength' => true, 'placeholder' => 'Nama Mapel']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
        <?php ActiveForm::end(); ?>
    </div>

</div>
