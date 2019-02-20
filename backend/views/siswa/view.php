<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswa */

$this->title = $model->profile->nama;
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-siswa-view">

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-danger">
                <div class="box-header">
                    <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
                <div class="box-body">
                    <?php 
                        $gridColumn = [
                            [
                                'attribute' => 'user.username',
                                'label' => 'User',
                            ],
                            [
                                'attribute' => 'profile.nama',
                                'label' => 'Nama',
                                'value' => function($model){
                                    return $model->profile->nama;
                                }
                            ],
                            [
                                'attribute' => 'kelas.guru_id',
                                'label' => 'Wali kelas',
                                'value' => function($model){
                                    return $model->kelas->guru->profile->nama;
                                }
                            ],
                            [
                                'attribute' => ['kelas.jurusan_id','kelas.kelas','kelas.grade'],
                                'label' => 'Kelas',
                                'value' => function($model){
                                    return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
                                }
                            ],
                            [
                                'attribute' => 'kelas.tahun',
                                'label' => 'Angkatan',
                                'value' => function($model){
                                    return $model->kelas->tahun;
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
            </div>
            <!-- end box -->
        </div>
        <!-- end col -->
        <div class="col-sm-6">
            <div class="box box-danger">
                <div class="box-header">
                    
                </div>
                <div class="box-body">
                    <?php 
                    $gridColumnModuleKelas = [
                        ['attribute' => 'id', 'visible' => false],

                        ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo DetailView::widget([
                        'model' => $model->kelas,
                        'attributes' => $gridColumnModuleKelas    ]);
                    ?>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->






























<?php
if($providerModuleSpp->totalCount){
    $gridColumnModuleSpp = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'bank.id',
                'label' => 'Bank'
            ],
            'bulan',
            'tahun',
            'bukti_bayar',
            'spp',
            'tabungan_prakerin',
            'tabungan_study_tour',
            'total',
            'status',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleSpp,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-spp']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Spp'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleSpp
    ]);
}
?>


</div>
