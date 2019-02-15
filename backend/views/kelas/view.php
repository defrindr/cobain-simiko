<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */

$this->title = $model->grade.' '.$model->getJurusan()->one()->nama.' '.$model->kelas;
$this->params['breadcrumbs'][] = ['label' => 'Module Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-kelas-view">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Yakin ingin menghapus data ini ?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
                <!-- end box header -->
                <div class="box-body">
                    <?php 
                        $gridColumn = [
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'jurusan.id',
                                'label' => 'Jurusan',
                                'value' => function($model){
                                    return $model->getJurusan()->one()->nama;
                                }
                            ],
                            [
                                'attribute' => 'guru.user_id',
                                'label' => 'Wali kelas',
                                'value' => function($model){
                                    return $model->getGuru()->one()->nama;
                                }
                            ],
                            'kelas',
                            'grade',
                            'tahun',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn
                        ]);
                    ?>
                </div>
            </div>
            <!-- end box-danger -->
        </div>
        <!-- end column -->
        <div class="col-md-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h4>Data Wali Kelas</h4>
                        </div>
                        <!-- end header box -->
                        <div class="box-body">
                                <?php 
                                $gridColumnModuleGuru = [
                                    'user_id',
                                    'nama',
                                    'mata_pelajaran_id',
                                    'avatar',
                                    ['attribute' => 'lock', 'visible' => false],
                                ];
                                echo DetailView::widget([
                                    'model' => $model->guru,
                                    'attributes' => $gridColumnModuleGuru    ]);
                                ?>
                        </div>
                        <!-- end box body -->
                    </div>
                    <!-- end box -->
                </div>
                <!-- end column -->

                <div class="col-sm-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h4>Data Jurusan</h4>
                        </div>
                        <!-- end header box -->
                        <div class="box-body">
                            <?php 
                            $gridColumnModuleJurusan = [
                                ['attribute' => 'id', 'visible' => false],
                                'nama',
                                'kepala_jurusan',
                                ['attribute' => 'lock', 'visible' => false],
                            ];
                            echo DetailView::widget([
                                'model' => $model->jurusan,
                                'attributes' => $gridColumnModuleJurusan    ]);
                            ?>
                        </div>
                        <!-- end box body -->
                    </div>
                    <!-- end box -->
                </div>
                <!-- end column -->

            </div>
            <!-- end row -->
        </div>
        <!-- end colmn -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h4>Daftar Murid</h4>
                </div>
                <!-- end box header -->
                <div class="box-body">
                    <?php
                    if($providerModuleSiswa->totalCount){
                        $gridColumnModuleSiswa = [
                            ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'user.username',
                                    'label' => 'User'
                                ],
                                            'nama',
                                'tempat_lahir',
                                'tanggal_lahir',
                                'avatar',
                                'no_telp',
                                'nama_wali',
                                'no_telp_wali',
                                ['attribute' => 'lock', 'visible' => false],
                        ];
                        echo Gridview::widget([
                            'dataProvider' => $providerModuleSiswa,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-siswa']],
                            'panel' => false,
                            'export' => false,
                            'columns' => $gridColumnModuleSiswa
                        ]);
                    }
                    ?>
                </div>
                <!-- end box body -->
            </div>
            <!-- end box -->
        </div>
        <!-- end column -->
    </div>
    <!-- end row -->














































<?php
if($providerModuleJadwal->totalCount){
    $gridColumnModuleJadwal = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'kodeMapel.id',
                'label' => 'Kode Mapel'
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
















<?php
if($providerModuleMateri->totalCount){
    $gridColumnModuleMateri = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'materiKategori.id',
                'label' => 'Materi Kategori'
            ],
            'judul',
            'gambar',
            'isi:ntext',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateri,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateri
    ]);
}
?>
