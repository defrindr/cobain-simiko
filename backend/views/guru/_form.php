<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleKelas', 
        'relID' => 'module-kelas', 
        'value' => \yii\helpers\Json::encode($model->moduleKelas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-guru-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-danger">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
                'options' => ['placeholder' => 'Choose User'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

            <?= $form->field($model, 'mata_pelajaran_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->orderBy('id')->asArray()->all(), 'id', 'nama_mapel'),
                'options' => ['placeholder' => 'Choose Module mata pelajaran'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
