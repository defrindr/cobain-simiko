<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoal */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-materi-soal-form">

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
                'options' => ['placeholder' => 'Materi'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?php echo $form->field($model, 'judul')->textInput(['maxlength' => true, 'placeholder' => 'Judul']) ?>

            <?= $form->field($model, 'isi')->textarea(['rows' => 6]) ?>

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
