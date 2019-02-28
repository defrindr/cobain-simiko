<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Spp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-spp-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Spp'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
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
    </div>

    <div class="row">
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
        'status',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleSiswa<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleSiswa = [
        'user_id',
        'kelas_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->siswa,
        'attributes' => $gridColumnModuleSiswa    ]);
    ?>
    <div class="row">
        <h4>ModuleBank<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleBank = [
        ['attribute' => 'id', 'visible' => false],
        'no_rekening',
        'nama_bank',
        'atas_nama',
        'gambar',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->bank,
        'attributes' => $gridColumnModuleBank    ]);
    ?>
</div>
