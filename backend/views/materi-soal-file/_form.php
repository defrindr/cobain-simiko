<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalFile */
/* @var $form yii\widgets\ActiveForm */

if(Yii::$app->user->can('Admin')){
    $materi_soal = common\models\ModuleMateriSoal::find()->orderBy('materi_id')->all();
}
else if(Yii::$app->user->can('Guru')){
    $materi_soal = common\models\ModuleMateriSoal::find()->where(["created_by"=>Yii::$app->user->id])->orderBy('materi_id')->all();
}
$list_materi_soal = [];

foreach ($materi_soal as $soal) {
    $list_materi_soal += [$soal->id => $soal->materi->judul." - ".$soal->judul];
}
?>

<div class="module-materi-soal-file-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <!-- end header box -->
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'materi_soal_id')->label('Materi Soal')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_materi_soal,
                'options' => ['placeholder' => 'Materi Soal'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'file')->widget(FileInput::classname(),[
                'options' => [
                    'accept' => 'image/*'
                ]
            ]) ?>

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
