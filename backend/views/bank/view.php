<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBank */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-bank-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Bank'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
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
    </div>

    <div class="row">
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
    </div>
    
    <div class="row">
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
</div>
