<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */
/* @var $form yii\widgets\ActiveForm */

$list_bulan = array(
    "Januari" => "Januari",
    "Februari" => "Februari",
    "Maret" => "Maret",
    "April" => "April",
    "Mei" => "Mei",
    "Juni" => "Juni",
    "Juli" => "Juli",
    "Agustus" => "Agustus",
    "September" => "September",
    "Oktober" => "Oktober",
    "November" => "November",
    "Desember" => "Desember"
);
$list_extra = [10000=>'10000',15000=>'15000',20000=>'20000',25000=>'25000',30000=>'30000'];

$list_spp = [150000=>'150000',175000=>'175000'];

$list_tahun = [];
foreach (range(date('Y'),date('Y')-3) as $each) {
    $list_tahun += [$each=>$each];
}

?>

<div class="module-spp-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <!-- end header box -->
        <div class="box-body">

            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'bank_id')->widget(\kartik\widgets\Select2::classname(), [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->orderBy('nama_bank')->asArray()->all(), 'id', 'nama_bank'),
                'options' => ['placeholder' => 'Nama Bank'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'bulan')
            ->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_bulan,
                'options' => ['placeholder'=>'Pilih Bulan'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'tahun')
            ->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_tahun,
                'options' => ['placeholder'=>'Pilih Tahun'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
             ?>

            <?= $form->field($model, 'image')
            ->widget(FileInput::classname(),[
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                    ],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                    ],
            ]) ?>

            <?= $form->field($model, 'spp')
            ->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_spp,
                'options' => ['placeholder'=>'Tabungan Study Tour'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'tabungan_prakerin')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_extra,
                'options' => ['placeholder'=>'Tabungan Prakerin'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>


            <?= $form->field($model, 'tabungan_study_tour')->widget(\kartik\widgets\Select2::classname(), [
                'data' => $list_extra,
                'options' => ['placeholder'=>'Tabungan Study Tour'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?php // $form->field($model, 'total')->textInput(['placeholder' => 'Total']) ?>

            <?php // $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

            <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
            </div>
            
        </div>
        <!-- end body box -->
    </div>






    <?php ActiveForm::end(); ?>

</div>
