<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-view">
    <div class="row">
        <div class="col-sm-8">
            <div class="box box-success">
                <div class="box-header">
                <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Anda yakin ingin menghapus ini ?',
                        'method' => 'post',
                    ],
                ])
                ?>
                <?php
                if($model->gambar != ""){
                    echo Html::a('Hapus Gambar', ['delete-image', 'id' => $model->id], [
                        'class' => 'btn btn-warning',
                        'data' => [
                            'confirm' => 'Anda yakin ingin menghapus gambar ?',
                            'method' => 'post'
                        ],
                ]);
                }
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
                            [
                                'attribute'=>'gambar',
                                'label' => 'Link gambar'
                            ],
                            [
                                'attribute' => 'kategori',
                                'value' => function($model){
                                    return $model->beritaKategori->nama;
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
        </div>
        <div class="col-sm-4">
                <div class="col-sm-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <h4>Gambar</h4>
                        </div>
                        <div class="box-body">
                            <?php 
                            $url = $model->gambar;
                            if($url != ""){
                                echo Html::img(Url::to(str_replace("/administrator","",Url::home())."/uploaded/berita/".$url),
                                    ['class' => 'img img-responsive']);
                            } else {
                                echo "<center><b>No Image</b></center>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end col 12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end col 5 -->
    </div>
    <!-- end row -->
</div>
