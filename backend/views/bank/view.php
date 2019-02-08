<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url; // require

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBank */

$this->title = $model->nama_bank;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-bank-view">

    <div class="row">
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header">
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
                <!-- end box header -->
                <div class="box-body">
                    <?php 
                        $gridColumn = [
                            ['attribute' => 'id', 'visible' => false],
                            'no_rekening',
                            'nama_bank',
                            'atas_nama',
                            'gambar',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn
                        ]);
                    ?>


                    <?php
                    if($providerModuleSpp->totalCount){
                        $gridColumnModuleSpp = [
                            ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id', 'visible' => false],
                                [
                                    'attribute' => 'siswa.user_id',
                                    'label' => 'Siswa'
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
                <!-- end box body -->
            </div>
            <!-- end box -->
        </div>
        <div class="col-md-4">
            <div class="box box-danger">
                <?php 
                    $fileName = $model->gambar;
                    $path = Url::base()."/uploaded/bank/".$fileName;
                    echo Html::img($path,[
                        'class' => 'img img-responsive'
                    ]);
                     ?>
            </div>
        </div>
    </div>

</div>
