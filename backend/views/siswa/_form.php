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

    <?= $form->field($model, 'kelas_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleKelas::find()->orderBy('id')->asArray()->all(), 'id', 'grade','kelas','jurusan'),
        'options' => ['placeholder' => 'Choose Module kelas'],
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

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('ModuleSpp'),
            'content' => $this->render('_formModuleSpp', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->moduleSpps),
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
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
