<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\FileInput;



// var_dump(\yii\helpers\ArrayHelper::map(\common\models\ModuleMateriKategori::find()->orderBy('id')->asArray()->all(), 'id','nama','mata_pelajaran_id'));
// exit();



/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateri */
/* @var $form yii\widgets\ActiveForm */

// \mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//     'viewParams' => [
//         'class' => 'ModuleMateriFile', 
//         'relID' => 'module-materi-file', 
//         'value' => \yii\helpers\Json::encode($model->moduleMateriFiles),
//         'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//     ]
// ]);
// \mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//     'viewParams' => [
//         'class' => 'ModuleMateriKomentar', 
//         'relID' => 'module-materi-komentar', 
//         'value' => \yii\helpers\Json::encode($model->moduleMateriKomentars),
//         'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//     ]
// ]);
// \mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
//     'viewParams' => [
//         'class' => 'ModuleMateriSoal', 
//         'relID' => 'module-materi-soal', 
//         'value' => \yii\helpers\Json::encode($model->moduleMateriSoals),
//         'isNewRecord' => ($model->isNewRecord) ? 1 : 0
//     ]
// ]);

$list_kelas = [];

$modelKelas = \common\models\ModuleKelas::find()->orderBy('id')->all();
foreach ($modelKelas as $kelas) {
    $list_kelas += [$kelas->id=>$kelas->grade." ".$kelas->jurusan->nama." ".$kelas->kelas];
}


// $list_bab = [];
// $modelBab = \common\models\ModuleMateriKategori::find()->orderBy('id')->all();
// foreach ($modelBab as $bab) {
//     $list_bab[$bab->mataPelajaran->nama_mapel] = [$bab->id => $bab->nama];
    // $list_bab = array_merge_recursive($list_bab,[$bab->mataPelajaran->nama_mapel => [$bab->id => $bab->nama]]);
// }
// echo "<pre>";
// print_r($list_bab);
// exit();


$guru = \common\models\ModuleGuru::find()->where('user_id='.Yii::$app->user->id)->one();

?>

<div class="module-materi-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <div class="box box-success">
                <div class="box-body">
                    
                    <?= $form->field($model, 'kelas_id')->label('Kelas')->widget(\kartik\widgets\Select2::classname(), [
                        'data' =>$list_kelas,
                        'options' => ['placeholder' => 'Kelas'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>

                    <?php 
                    if(Yii::$app->user->identity->role == 20) { ?>
                        <?= $form->field($model, 'materi_kategori_id')->label('Bab Materi')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateriKategori::find()->where('mata_pelajaran_id='.$guru->mata_pelajaran_id)->orderBy('id')->asArray()->all(), 'id','nama'),
                            'options' => ['placeholder' => 'Pilih Bab Materi'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>

                    <?php } elseif (Yii::$app->user->can('Admin')) { ?>
                        <?= $form->field($model, 'materi_kategori_id')->label('Bab Materi')->widget(\kartik\widgets\Select2::classname(), [
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateriKategori::find()->orderBy('id')->asArray()->all(), 'id','nama'),
                            'options' => ['placeholder' => 'Pilih Bab Materi'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                        
                    <?php } ?>


                    <?= $form->field($model, 'image')->widget(FileInput::classname(),[
                        'options' => ['accept'=>'image/*']
                    ]) ?>

                </div>
            </div>
        </div>
        <div class="col-sm-8">
            

            <div class="box box-success">
                <div class="box-header">
                    <?= $form->errorSummary($model); ?>
                    
                </div>
                <!-- end header box -->
                <div class="box-body">
                    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

                    <?= $form->field($model, 'judul')->textInput(['maxlength' => true, 'placeholder' => 'Judul']) ?>

                    <?= $form->field($model, 'isi')->widget(\yii\redactor\widgets\Redactor::className()) ?>

                    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', 'Batal'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
                    </div>
                    
                </div>
        </div>
    </div>

        <!-- end body box -->
    </div>






    <?php ActiveForm::end(); ?>

</div>
