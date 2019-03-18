<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */

$this->title = $model->grade.' '.$model->getJurusan()->one()->nama.' '.$model->kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;







?>
<div class="module-kelas-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
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
                            // [
                            //     'attribute' => 'jurusan.id',
                            //     'label' => 'Jurusan',
                            //     'value' => function($model){
                            //         return $model->getJurusan()->one()->nama;
                            //     }
                            // ],
                            // [
                            //     'attribute' => 'guru.user_id',
                            //     'label' => 'Wali kelas',
                            //     'value' => function($model){
                            //         return $model->getGuru()->one()->nama;
                            //     }
                            // ],
                            [
                                'attribute' => 'kelas',
                                'value' => function($model){
                                    return $model->grade.' '.$model->getJurusan()->one()->nama.' '.$model->kelas;
                                }
                            ],
                            [
                                'attribute'=>'nama',
                                'label' => 'Nama Wali Kelas',
                                'format'=>'raw',
                                'value' => function($model){
                                    return '<a href="'.Url::to(['/guru/view/'.$model->guru->user_id]).'">'.$model->guru->getProfile()->one()->nama.'</a>';
                                }
                            ],
                            // [
                            //     'attribute' => 'jml_siswa',
                            //     'value' => function($model){
                            //         return $model->moduleSiswas;
                            //     }
                            // ],
                            [
                                'attribute'=>'kepala_jurusan',
                                'value' => function($model){
                                    return $model->jurusan->kepala_jurusan;
                                }
                            ],
                            ['attribute'=>'tahun','label'=>'Tahun Ajaran'],
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn
                        ]);
                    ?>
                </div>
                <!-- end box body -->
            </div>
            <!-- end box -->
        </div>
        <!-- end colmn -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header">
                    <h4>Siswa</h4>
                </div>
                <!-- end box header -->
                <div class="box-body">
                   <?php
                    if($providerModuleSiswa->totalCount){
                        $gridColumnModuleSiswa = [
                            ['class' => 'yii\grid\SerialColumn'],
                                // [
                                //     'attribute' => 'user.username',
                                //     'label' => 'User'
                                // ],
                                [
                                    'attribute'=>'nama',
                                    'value'=>function($model){
                                        return $model->profile->nama;
                                    }
                                ],
                                // 'tempat_lahir',
                                // 'tanggal_lahir',
                                // 'avatar',
                                // 'no_telp',
                                // 'nama_wali',
                                // 'no_telp_wali',
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
                    } else {
                        echo "Belum ada siswa";
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
    echo '
<div class="box box-success">
    <div class="box-header">
    <h4>Jadwal</h4>
    </div>
    <div class="box-body">';
    $gridColumnModuleJadwal = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            // 'id',
            [
                'attribute' => 'kode_guru',
                'label' => 'Guru',
                'value' => function($model) {
                    return $model->kodeGuru->profile->nama;
                }
            ],
            [
                'attribute' => 'mapel',
                'label' => 'Mata Pelajaran',
                'value' => function($model) {
                    return $model->kodeGuru->mataPelajaran->nama_mapel;
                }
            ],
            'hari',
            'jam_mulai',
            'jam_selesai',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleJadwal,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jadwal']],
        'panel' => false,
        'export' => false,
        'columns' => $gridColumnModuleJadwal
    ]);
    echo '
    </div>
</div>
    ';
}
?>





<?php
if($providerModuleMateri->totalCount){
    echo '
<div class="box box-success">
    <div class="box-header">
        <h4>Materi</h4>
    </div>
    <div class="box-body">
    ';
    $gridColumnModuleMateri = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'materiKategori.id',
                'label' => 'Materi Kategori'
            ],
            'judul',
            'gambar',
            [
                'attribute' => 'isi',
                'label' => 'Content',
                'value' => function($model){
                    return StringHelper::truncateWords($model->isi,5,'...');
                }
            ],
            ['attribute' => 'lock', 'visible' => false],
        ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateri,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi']],
        'panel' => false,
        'export' => false,
        'columns' => $gridColumnModuleMateri
    ]);
    echo '
    </div>
</div>
    ';
}
?>
