<?php

use yii\helpers\Html; 
use yii\widgets\ActiveForm; 

/* @var $this yii\web\View */ 
/* @var $model common\models\ModuleProfileSearch */ 
/* @var $form yii\widgets\ActiveForm */ 
?> 

<div class="form-module-profile-search"> 
    <div class="container-fluid">

        <?php $form = ActiveForm::begin([ 
            'action' => ['all'], 
            'method' => 'get', 
        ]); ?> 

        <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [ 
            'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'), 
            'options' => ['placeholder' => 'Pilih User'], 
            'pluginOptions' => [ 
                'allowClear' => true 
            ], 
        ]); ?>

        <?= $form->field($model,'jenis_kelamin')->widget(\kartik\widgets\Select2::classname(),[
            'data' => [
                'L' => 'Laki-Laki',
                'P' => 'Perempuan'
            ],
            'options' => ['placeholder' => 'Pilih User'], 
            'pluginOptions' => [ 
                'allowClear' => true 
            ], 
         ]) ?>

        <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

        <?= $form->field($model, 'tgl_lahir')->textInput(['placeholder' => 'Tgl Lahir']) ?>

        <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

        <?php // echo $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

        <?php /* echo $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'No Telp']) */ ?>

        <?php /* echo $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) */ ?>

        <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

        <div class="form-group"> 
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?> 
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?> 
        </div> 

        <?php ActiveForm::end(); ?> 
        
    </div>

</div> 