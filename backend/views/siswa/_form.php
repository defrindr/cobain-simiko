<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswa */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleSpp', 
        'relID' => 'module-spp', 
        'value' => \yii\helpers\Json::encode($model->moduleSpps),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-siswa-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-danger">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'user_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->where('role=30')->orderBy('id')->asArray()->all(), 'id', 'username'),
                'options' => ['placeholder' => 'Pilih User'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'kelas_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleKelas::find()->orderBy('id')->asArray()->all(), 'id', 'grade','kelas','jurusan'),
                'options' => ['placeholder' => 'Pilih kelas'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

            <?= $form->field($model, 'tanggal_lahir')->widget(\kartik\datecontrol\DateControl::classname(), [
                'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'saveFormat' => 'php:Y-m-d H:i:s',
                'ajaxConversion' => true,
                'options' => [
                    'pluginOptions' => [
                        'placeholder' => 'Choose Tanggal Lahir',
                        'autoclose' => true,
                    ]
                ],
            ]); ?>

            <?= $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) ?>

            <?= $form->field($model, 'no_telp')->textInput(['maxlength' => true, 'placeholder' => 'No Telp']) ?>

            <?= $form->field($model, 'nama_wali')->textInput(['maxlength' => true, 'placeholder' => 'Nama Wali']) ?>

            <?= $form->field($model, 'no_telp_wali')->textInput(['maxlength' => true, 'placeholder' => 'No Telp Wali']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
        </div>
    </div>





    


    <?php ActiveForm::end(); ?>

</div>
