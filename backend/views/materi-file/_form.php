<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriFile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-materi-file-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <!-- end header box -->
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'materi_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateri::find()->orderBy('id')->asArray()->all(), 'id', 'judul'),
                'options' => ['placeholder' => 'Choose Module materi'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'nama_file')->textInput(['maxlength' => true, 'placeholder' => 'Nama File']) ?>

            <?= $form->field($model, 'file')->fileInput(['class'=>'form-control']) ?>

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
