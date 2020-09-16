<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateri */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label'=>'Materi','url'=>['/materi']];
$this->params['breadcrumbs'][] = ['label' => $model->materiKategori->mataPelajaran->nama_mapel, 'url'=> '#'];
$this->params['breadcrumbs'][] = ['label' => $model->materiKategori->nama, 'url' => '#'];
$this->params['breadcrumbs'][] = $this->title;
$ModuleProfile = \common\models\ModuleProfile::find()->where('user_id='.Yii::$app->user->id)->one();
$nama = $ModuleProfile->nama;
?>
<div class="module-materi-view">
    <div class="box box-materi" style="padding: 2rem">
        <p>
            <div class="row">
                <div class="col-xs-11 col-sm-11 col-md-11">
                    <i class="glyphicon glyphicon-user"></i> <?= $nama ?>
                    <br>
                    <i class="glyphicon glyphicon-time"></i> <?php echo  date("l F o",$model->created_at) ?>
                    <br>
                    <i class="glyphicon glyphicon-file"></i> <?= $providerModuleMateriFile->totalCount ?> Lampiran
                    
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <i class="glyphicon glyphicon-comment"></i> <?= $providerModuleMateriKomentar->totalCount ?>
                </div>
            </div>
        </p>
        <center>
            <?= Html::img(Url::base()."/uploaded/materi/".$model->gambar,['class'=>'img img-responsive']) ?>
        </center>
        <p style="min-height: 100px;padding:20px 10px 10px">
            <?= $model->isi?>
        </p>
        <?php if ($providerModuleMateriFile->count > 0){
            $modelLampiran = \common\models\ModuleMateriFile::find()->where(["materi_id"=>$model->id])->all(); ?>
                <h4>Lampiran</h4>
            <?php foreach ($modelLampiran as $lampiran) {
                ?>
                    <li><a href="<?= Url::to("@web/uploaded/materi-file/".$lampiran->link_file) ?>" target="_blank"><?= $lampiran->nama_file ?></a></li>
                <?php
            }
        }
        if($providerModuleMateriSoal->totalCount){
            $modelSoal = \common\models\ModuleMateriSoal::find()->where(["materi_id"=>$model->id])->all(); ?>
            <h4>Soal</h4>
            <?php foreach ($modelSoal as $soal) {
                ?>
                <li><a href="<?= Url::to(['/materi-soal/show','id'=> $soal->id])?>" class="btn-actionColumn"><?= $soal->judul ?></a></li>
                <?php
            } ?>
        <?php } ?>
    </div>
    
    <?= $this->render('_view_komentar',['providerModuleMateriKomentar' => $providerModuleMateriKomentar,'model'=>$model]) ?>

    <?=  $this->render('_formKomentar', ['model' => $modelKomentar]); ?>
<!--     <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'kelas.id',
            'label' => 'Kelas',
        ],
        [
            'attribute' => 'materiKategori.id',
            'label' => 'Materi Kategori',
        ],
        'judul',
        'gambar',
        [
            'attribute'=>'isi',
            'format' => 'raw',
            'value' => function($model){
                return htmlentities($model->isi);
            }
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleKelas<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleKelas = [
        ['attribute' => 'id', 'visible' => false],
        'jurusan_id',
        'guru_id',
        'kelas',
        'grade',
        'tahun',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->kelas,
        'attributes' => $gridColumnModuleKelas    ]);
    ?>
    <div class="row">
        <h4>ModuleMateriKategori<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMateriKategori = [
        ['attribute' => 'id', 'visible' => false],
        'mata_pelajaran_id',
        'nama',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->materiKategori,
        'attributes' => $gridColumnModuleMateriKategori    ]);
    ?>
    
    <div class="row">
<?php
if($providerModuleMateriFile->totalCount){
    $gridColumnModuleMateriFile = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'nama_file',
            'link_file',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriFile,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-file']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi File'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriFile
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleMateriKomentar->totalCount){
    $gridColumnModuleMateriKomentar = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
                        'subject',
            'komentar:ntext',
            'status',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriKomentar,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-komentar']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Komentar'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriKomentar
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleMateriSoal->totalCount){
    $gridColumnModuleMateriSoal = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'judul',
            'isi:ntext',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriSoal,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Soal'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriSoal
    ]);
}
?> -->

    </div>
</div>
