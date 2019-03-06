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

<!--     <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Materi'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div> -->
    <div class="box" style="border: 0;padding:12px 20px">
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
            <?= Html::img(Url::base()."/uploaded/materi/".$model->gambar,['class'=>'img img-responsive','style'=>'max-width:350px;max-height:350px;']) ?>
        </center>
        <p style="min-height: 100px;padding:20px 10px 10px">
            <?= $model->isi?>
        </p>
    </div>
    <div class="box" style="border: 0;padding:12px;position: relative;">
        <h3>Komentar</h3>
        <hr>
        <?php if($providerModuleMateriKomentar->totalCount == 0){
            echo "Belum ada komentar.";
        }else {
            $moduleKomentar = \common\models\ModuleMateriKomentar::find()->where('materi_id='.$model->id)->all();
            foreach ($moduleKomentar as $komentar) {
                // $photo = \common\models\ModuleProfile::find()->where('user_id='.$komentar->user_id)->one();
             ?>
                <div style="border: 1px solid #aaa;border-left:3px solid <?php $a=['red','green','blue','purple','yellow']; echo $a[random_int(0,2)]; ?>;margin: 4px 0;padding: 20px">
                    <div class="row">
                        <div class="col-sm-2 col-xs-3 col-md-1 col-lg-1">
                            <?= Html::img(Url::base()."/uploaded/img-profil/".$komentar->profile->avatar,['class'=>'img img-circle','style'=>'width:60px;height:60px;']) ?>
                        </div>
                        <div class="col-sm-10 col-xs-9 col-md-11 col-lg-11">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span style="font-size: 18px">
                                        <?= $komentar->profile->nama ?>
                                    </span>
                                    <?php if($komentar->created_by == $model->created_by) {echo '<p class="badge label-primary" style="padding:3px 12px;border:0;display:inline-block">creator</p>'; } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                        <?= date('H:i:s l F o',$komentar->created_at); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <span style="font-size: 14px"><b><?= $komentar->subject ?></b></span>
                            <br/>
                            <?= $komentar->komentar ?>
                        </div>
                    </div>
                </div>

            <?php }
        } ?>
    </div>
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
