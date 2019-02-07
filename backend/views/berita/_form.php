<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-berita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'berita_kategori_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBeritaKategori::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Module berita kategori'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'judul')->textInput(['maxlength' => true, 'placeholder' => 'Judul']) ?>

    <?= $form->field($model, 'isi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gambar')->textInput(['maxlength' => true, 'placeholder' => 'Gambar']) ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
