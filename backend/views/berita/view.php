<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-view">
    <div class="row">
        <div class="col-sm-7">
            <box class="box-danger">
                <div class="box-header">
                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
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
                            ['attribute' => 'id', 'visible' => false],
                            [
                                'attribute' => 'beritaKategori.id',
                                'label' => 'Berita Kategori',
                            ],
                            'judul',
                            'isi:ntext',
                            'gambar',
                            ['attribute' => 'lock', 'visible' => false],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn
                        ]);
                    ?>
                </div>
            </box>
        </div>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-sm-12">
                    <box class="box-danger">
                        <div class="box-header">
                            <div class="row">
                                <h4>Kategori</h4>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php 
                            $gridColumnModuleBeritaKategori = [
                                ['attribute' => 'id', 'visible' => false],
                                'nama',
                                ['attribute' => 'lock', 'visible' => false],
                            ];
                            echo DetailView::widget([
                                'model' => $model->beritaKategori,
                                'attributes' => $gridColumnModuleBeritaKategori    ]);
                            ?>
                        </div>
                    </box>
                </div>
                <!-- end col 12 -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-sm-12">
                    <box class="box-danger">
                        <div class="box-header">
                            <h4>Gambar</h4>
                        </div>
                        <div class="box-body">
                            <?php 
                                $gridColumn = [
                                    [
                                        'attribute' => 'gambar',
                                        'label' => '',
                                        'format' =. 'html',
                                        'value' => function(){
                                            return 
                                        }
                                    ]
                                ];
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => $gridColumn
                                ]);
                            ?>
                        </div>
                    </box>
                </div>
                <!-- end col 12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end col 5 -->
    </div>
    <!-- end row -->
</div>
