<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-kelas-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'jurusan_id')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJurusan::find()->orderBy('id')->asArray()->all(), 'id', 'nama'),
                'options' => ['placeholder' => 'Pilih jurusan'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'guru_id')->widget(Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleGuru::find()->innerJoinWith(['profile'])->orderBy('profile.user_id')->asArray()->all(), 'user_id', 'profile.nama'),
                'options' => ['placeholder' => 'Pilih guru'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'kelas')->textInput(['maxlength' => true, 'placeholder' => 'Kelas']) ?>


            <?= $form->field($model, 'grade')->widget(Select2::classname(),[
                'data' => ['X'=>'X','XI'=>'XI','XII'=>'XII'],
                'options' => ['placeholder' => 'Grade'],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]); ?>


            <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'placeholder' => 'Tahun']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
