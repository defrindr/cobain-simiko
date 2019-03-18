<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */
/* @var $form yii\widgets\ActiveForm */


/**
 * List Kelas
 *
 * Mengambil data semua kelas dan meletakkannya dalam array
 * 
 * @return array
 */

$kelas = \common\models\ModuleKelas::find()->orderBy('kelas')->all();
$list_kelas = [];
foreach ($kelas as $each) {
    $list_kelas += [$each->id=>$each->grade." ".$each->jurusan->nama." ".$each->kelas];
}


/**
 * List Jam
 * @var Array
 */
$list_jam = [
    '07.00'=>'07.00',
    '07.40'=>'07.40',
    '08.20'=>'08.20',
    '10.00'=>'10.00',
    '10.40'=>'10.40',
    '11.20'=>'11.20',
    '12.00'=>'12.00',
    '12.40'=>'12.40',
    '13.20'=>'13.20',
    '14.20'=>'14.20',
    '15.00'=>'15.00',
    '15.40'=>'15.40'
];


/**
 * List Hari
 * @var Array
 */
$list_hari = [
    'senin' => 'senin',
    'selasa' => 'selasa',
    'rabu' => 'rabu',
    'kamis' => 'kamis',
    'jum\'at' => 'jum\'at',
    'sabtu' => 'sabtu'
];

/**
 * List Guru
 *
 * Mengambil data semua guru dan meletakkannya dalam array
 * 
 * @return array
 */

$guru =  \common\models\ModuleGuru::find()->all();
$list_guru = [];
foreach ($guru as $each) {
    $tmp = [$each->mataPelajaran->nama_mapel=>[$each->id=>$each->profile->nama]];
    $list_guru = array_merge_recursive($list_guru,$tmp);
}
// var_dump($list_guru);
// exit();

?>

<div class="module-jadwal-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="box box-success">
        <div class="box-header">
            <?= $form->errorSummary($model); ?>
        </div>
        <!-- end header box -->
        <div class="box-body">
            <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

            <?= $form->field($model, 'kelas_id')
            ->label('Kelas')
            ->widget(Select2::classname(), [
                'data' => $list_kelas,
                'options' => ['placeholder' => 'Pilih kelas'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'kode_guru')
            ->label('Mata pelajaran')
            ->widget(Select2::classname(), [
                'data' => $list_guru,
                'options' => ['placeholder' => 'Pilih mata pelajaran'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'jam_mulai')
            ->widget(Select2::classname(),[
                'data' => $list_jam,
                'options' => [
                    'placeholder' => 'Jam Mulai'
                ],
               'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'jam_selesai')
            ->widget(Select2::classname(),[
                'data' => $list_jam,
                'options' => [
                    'placeholder' => 'Jam Selesai'
                ],
               'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

            <?= $form->field($model, 'hari')
            ->widget(Select2::classname(),[
                'data' => $list_hari,
                'options' => [
                    'placeholder' => 'Pilih Hari'
                ],
               'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ?>

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
