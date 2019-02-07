<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBeritaKategori */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'ModuleBerita', 
        'relID' => 'module-berita', 
        'value' => \yii\helpers\Json::encode($model->moduleBeritas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="module-berita-kategori-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-danger">
        <div class="box-header">
    <?= $form->errorSummary($model); ?>
        </div>
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?php
            $forms = [
                [
                    'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('ModuleBerita'),
                    'content' => $this->render('_formModuleBerita', [
                        'row' => \yii\helpers\ArrayHelper::toArray($model->moduleBeritas),
                    ]),
                ],
            ];
            echo kartik\tabs\TabsX::widget([
                'items' => $forms,
                'position' => kartik\tabs\TabsX::POS_ABOVE,
                'encodeLabels' => false,
                'pluginOptions' => [
                    'bordered' => true,
                    'sideways' => true,
                    'enableCache' => false,
                ],
            ]);
            ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
