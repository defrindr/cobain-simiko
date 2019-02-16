<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="module-profile-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-danger">
        <div class="box-header">
            
        </div>
        <div class="box-body">
            
        </div>
    </div>





    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput(['placeholder' => 'Tgl Lahir']) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'No Telp']) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
