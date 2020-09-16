<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriKomentar */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-materi-komentar-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-materi">
        <div class="box-header">
            <h4>Tambah Komentar</h4>
        </div>
        <hr>
        <!-- end header box -->
        <div class="box-body">
            
		    <?= $form->errorSummary($model); ?>

		    <?php //echo $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


		    <?php echo $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => 'Subject']) ?>

		    <?php echo $form->field($model, 'komentar')->textarea(['rows' => 6]) ?>

		    <?php //echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

		    <?php //echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

		    <div class="form-group">
		        <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
		    </div>
        </div>
        <!-- end body box -->
    </div>






    <?php ActiveForm::end(); ?>

</div>
