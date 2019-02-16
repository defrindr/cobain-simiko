<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleJadwal', 
        'relID' => 'module-jadwal', 
        'value' => \yii\helpers\Json::encode($model->moduleJadwals),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleMateri', 
        'relID' => 'module-materi', 
        'value' => \yii\helpers\Json::encode($model->moduleMateris),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleSiswa', 
        'relID' => 'module-siswa', 
        'value' => \yii\helpers\Json::encode($model->moduleSiswas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-kelas-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-danger">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'jurusan_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJurusan::find()->orderBy('id')->asArray()->all(), 'id', 'nama'),
                'options' => ['placeholder' => 'Choose Module jurusan'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'guru_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleGuru::find()->innerJoinWith(['profile'])->orderBy('profile.user_id')->asArray()->all(), 'user_id', 'profile.nama'),
                'options' => ['placeholder' => 'Choose Module guru'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'kelas')->textInput(['maxlength' => true, 'placeholder' => 'Kelas']) ?>

            <?= $form->field($model, 'grade')->textInput(['maxlength' => true, 'placeholder' => 'Grade']) ?>

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
