<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMataPelajaran */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Mata Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-mata-pelajaran-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Mata Pelajaran'.' '. Html::encode($this->title) ?></h2>
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
        'nama_mapel',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerModuleGuru->totalCount){
    $gridColumnModuleGuru = [
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user.username',
                'label' => 'User'
            ],
            'nama',
                        'avatar',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleGuru,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-guru']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Guru'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleGuru
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleJadwal->totalCount){
    $gridColumnModuleJadwal = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'kelas.id',
                'label' => 'Kelas'
            ],
                        'jam_mulai',
            'jam_selesai',
            'hari',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleJadwal,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jadwal']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Jadwal'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleJadwal
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleMateriKategori->totalCount){
    $gridColumnModuleMateriKategori = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'nama',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriKategori,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-kategori']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Kategori'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriKategori
    ]);
}
?>

    </div>
</div>
