<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSppSearch */
/* @var $form yii\widgets\ActiveForm */

$namaAll = common\models\ModuleSiswa::find()->all();
$nama= [];
foreach ($namaAll as $each) {
    $nama += [$each->user_id=>$each->profile->nama];
}
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

<div class="form-module-spp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['pdf'],
        'method' => 'post',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'siswa_id')->widget(Select2::classname(), [
        'data' => $nama,
        'options' => ['placeholder' => 'Siswa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php /* $form->field($model, 'bank_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->orderBy('id')->asArray()->all(), 'id', 'nama_bank'),
        'options' => ['placeholder' => 'Bank'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);*/ ?>

    <?= $form->field($model, 'bulan')->widget(Select2::classname(),[
    	'data' => $list_bulan,
        'options' => ['placeholder' => 'Bulan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'placeholder' => 'Tahun']) ?>

    <?php /* echo $form->field($model, 'bukti_bayar')->textInput(['maxlength' => true, 'placeholder' => 'Bukti Bayar']) */ ?>

    <?php /* echo $form->field($model, 'spp')->textInput(['placeholder' => 'Spp']) */ ?>

    <?php /* echo $form->field($model, 'tabungan_prakerin')->textInput(['placeholder' => 'Tabungan Prakerin']) */ ?>

    <?php /* echo $form->field($model, 'tabungan_study_tour')->textInput(['placeholder' => 'Tabungan Study Tour']) */ ?>

    <?php /* echo $form->field($model, 'total')->textInput(['placeholder' => 'Total']) */ ?>

    <?php echo $form->field($model, 'status')->widget(Select2::classname(),[
        'data' => [
            1 => 'Sudah Divalidasi',
            0 => 'Belum Divalidasi'
        ],
        'options'=> ['placeholder'=>'status'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?php /* echo $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); */ ?>

    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
