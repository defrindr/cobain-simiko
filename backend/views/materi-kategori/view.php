<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriKategori */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-kategori-view">
    <div class="box box-success">
        <div class="box-header">
            <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Yakin Ingin Menghapus Ini?',
                    'method' => 'post',
                ],
            ])
            ?>
            
        </div>
        <div class="box-body">
            <?php 
                $gridColumn = [
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'mataPelajaran.id',
                        'label' => 'Mata Pelajaran',
                        'value' => function($model){
                            return $model->mataPelajaran->nama_mapel;
                        }
                    ],
                    'nama',
                    ['attribute' => 'lock', 'visible' => false],
                ];
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                ]);
            ?>
            
        </div>
    </div>
    <!-- end box -->
    <?php if($providerModuleMateri->totalCount){ ?>
    <div class="box box-info">
        <div class="box-header">
            
        </div>
        <div class="box-body">
            <?php
                    $gridColumnModuleMateri = [
                        ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'kelas.id',
                                'label' => 'Kelas',
                                'value' => function($model){
                                    return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
                                }
                            ],
                            'judul',
                            // 'gambar',
                            // 'isi:ntext',
                            ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo Gridview::widget([
                        'dataProvider' => $providerModuleMateri,
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi']],
                        'panel' => 0,
                        'export' => false,
                        'columns' => $gridColumnModuleMateri
                    ]);
                
                ?>
        </div>
    </div>
    <?php } ?>
</div>
