<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-berita-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'berita_kategori_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBeritaKategori::find()->orderBy('id')->asArray()->all(), 'id', 'nama'),
                'options' => ['placeholder' => 'Choose Module berita kategori'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'judul')->textInput(['maxlength' => true, 'placeholder' => 'Judul']) ?>

            <?= $form->field($model, 'isi')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                ]);?>

            <?= $form->field($model, 'gambar', ['template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Gambar','style' => 'display:none']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
