<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback text-white'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback text-white'></span>"
];
$checkboxTemplate = '<div class="switch">{beginLabel}{input}{labelTitle}<span class="lever"></span>{endLabel}{error}{hint}</div>';
?>
  <div class="row fullHeight">
    <div class="col-sm-4 leftCol">
        <center>
            <h2><b>L</b>ogin Page</h2>
            SMK Negeri 1 Jenangan
            <img src="<?=yii\helpers\Url::base().'/assets/logo/smk.png'?>" class="img img-responsive imgLogin">
        </center>
    </div>
    <div class="col-sm-8 rightCol">
      <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['class'=>'formInput form-control', 'placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['class'=>'formInput form-control', 'placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe',['options'=>['class'=>'form-group checkbox']])->widget(CheckboxX::classname(), []); ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-login btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
  </div>
