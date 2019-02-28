<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriKategori */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleMateri', 
        'relID' => 'module-materi', 
        'value' => \yii\helpers\Json::encode($model->moduleMateris),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-materi-kategori-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="container-fluid">
            <?= $form->errorSummary($model); ?>
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
            <?php if(Yii::$app->user->identity->role != 20){ ?>

                <?= $form->field($model, 'mata_pelajaran_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->orderBy('id')->asArray()->all(), 'id', 'nama_mapel'),
                    'options' => ['placeholder' => 'Choose Module mata pelajaran'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            <?php } ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
        
    </div>
            




    <?php ActiveForm::end(); ?>

</div>
