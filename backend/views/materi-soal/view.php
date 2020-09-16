<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Soal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Materi Soal'.' '. Html::encode($this->title) ?></h2>
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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'materi.id',
            'label' => 'Materi',
        ],
        'judul',
        'isi:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleMateri<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMateri = [
        ['attribute' => 'id', 'visible' => false],
        'kelas_id',
        'materi_kategori_id',
        'judul',
        'gambar',
        'isi:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->materi,
        'attributes' => $gridColumnModuleMateri    ]);
    ?>
    
    <div class="row">
<?php
if($providerModuleMateriSoalFile->totalCount){
    $gridColumnModuleMateriSoalFile = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'gambar',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriSoalFile,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal-file']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Soal File'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriSoalFile
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleMateriSoalJawaban->totalCount){
    $gridColumnModuleMateriSoalJawaban = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'siswa_id',
            'link',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriSoalJawaban,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal-jawaban']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Soal Jawaban'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriSoalJawaban
    ]);
}
?>

    </div>
</div>
