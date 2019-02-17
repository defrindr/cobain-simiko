<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBank */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleSpp', 
        'relID' => 'module-spp', 
        'value' => \yii\helpers\Json::encode($model->moduleSpps),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-bank-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="container-fluid">
        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field($model, 'no_rekening')->textInput(['maxlength' => true, 'placeholder' => 'No Rekening']) ?>

        <?= $form->field($model, 'nama_bank')->textInput(['maxlength' => true, 'placeholder' => 'Nama Bank']) ?>

        <?= $form->field($model, 'atas_nama')->textInput(['maxlength' => true, 'placeholder' => 'Atas Nama']) ?>

        <?= $form->field($model, 'gambar',['template'=>'{input}'])->textInput(['style' => 'display:none','maxlength' => true, 'placeholder' => 'Gambar']) ?>

        <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            ]);?>

        <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
             <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
         </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
