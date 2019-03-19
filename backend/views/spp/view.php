<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */




$this->title = "Pembayaran spp ".$model->bulan." ".$model->tahun." oleh ".$model->siswa->profile->nama;
$this->params['breadcrumbs'][] = ['label' => 'SPP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-spp-view">
    <div class="box box-success">
        <div class="box-header">
            <?php //echoHtml::a('<i class="fa glyphicon glyphicon-book"></i> ' . 'PDF', ['pdf', 'id' => $model->id],['class' => 'btn btn-danger','target' => '_blank','data-toggle' => 'tooltip','title' => 'Will open the generated PDF file in a new window'])?>
            
            <?php if($model->status == 0) {?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
            <?php } ?>
        </div>
        <div class="box-body">
        <?php 
            $gridColumn = [
                ['attribute' => 'id', 'visible' => false],
                [
                    'attribute' => 'siswa.user_id',
                    'label' => 'Siswa',
                    'value' => function($model){
                        return $model->siswa->profile->nama;
                    }
                ],
                [
                    'attribute' => 'bank.id',
                    'label' => 'Bank',
                ],
                'bulan',
                'tahun',
                [
                    'attribute'=>'bukti_bayar',
                    'format' => 'raw',
                    'value' => function($model){
                        if(file_exists(Url::to("@webroot/uploaded/spp/".$model->bukti_bayar))){
                            return Html::a($model->bukti_bayar,["/uploaded/spp/".$model->bukti_bayar],['target'=>'_blank','style'=>'word-break:break-all']);
                            
                        }else {
                            return "File Hilang";
                        }
                    }
                ],
                [
                    'attribute' => 'spp',
                    'value' => function($model){
                        return "Rp. ".$model->spp;
                    }
                ],
                [
                    'attribute' => 'tabungan_prakerin',
                    'value' => function($model){
                        return "Rp. ".$model->tabungan_prakerin;
                    }
                ],
                [
                    'attribute' => 'spp',
                    'value' => function($model){
                        return "Rp. ".$model->tabungan_study_tour;
                    }
                ],
                [
                    'attribute' => 'total',
                    'value' => function($model){
                        return "Rp. ".$model->total;
                    }
                ],
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
                // 'options' => ['style'=>'word-break:break-all'],
                'attributes' => $gridColumn
            ]);
        ?>

        </div>
    </div>
</div>
