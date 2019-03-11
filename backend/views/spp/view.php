<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */

$this->title = "Pembayaran spp ".$model->bulan." ".$model->tahun." oleh ".$model->siswa->profile->nama;
$this->params['breadcrumbs'][] = ['label' => 'SPP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-spp-view">
    <div class="box box-success">
        <div class="box-header">
            <?=
             Html::a('<i class="fa glyphicon glyphicon-book"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
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
        <div class="box-body">
        <?php 
            $gridColumn = [
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'siswa.user_id',
                    'label' => 'Siswa',
                ],
                [
                    'attribute' => 'bank.id',
                    'label' => 'Bank',
                ],
                'bulan',
                'tahun',
                'bukti_bayar',
                'spp',
                'tabungan_prakerin',
                'tabungan_study_tour',
                'total',
                [
                    'attribute'=>'status',
                    'value' => function($model){
                        return ($model->status==1 ? "Sudah Divalidasi" : "Belum divalidasi");
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
