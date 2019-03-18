<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas." Jam ".$model->jam_mulai."-".$model->jam_selesai;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jadwal-view">
    <div class="box box-success">
        <div class="box-header">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary','data'=>['method'=>'post']]) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
                        'attribute' => 'kelas.id',
                        'label' => 'Kelas',
                        'value' => function($model){
                            return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
                        }
                    ],
                    [
                        'attribute' => 'kodeGuru.user_id',
                        'label' => 'Mapel',
                        'value' => function($model){
                            return $model->kodeGuru->profile->nama;
                        }
                    ],
                    [
                        'attribute' => 'mata-pelajaran',
                        'label' => 'Mata Pelajaran',
                        'value' => function($model){
                            return $model->kodeGuru->mataPelajaran->nama_mapel;
                        }
                    ],
                    'hari',
                    'jam_mulai',
                    'jam_selesai',
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
