<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jadwal-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Jadwal'.' '. Html::encode($this->title) ?></h2>
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
        [
            'attribute' => 'kelas.id',
            'label' => 'Kelas',
        ],
        [
            'attribute' => 'kodeMapel.id',
            'label' => 'Kode Mapel',
        ],
        'jam_mulai',
        'jam_selesai',
        'hari',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleKelas<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleKelas = [
        ['attribute' => 'id', 'visible' => false],
        'jurusan_id',
        'guru_id',
        'kelas',
        'grade',
        'tahun',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->kelas,
        'attributes' => $gridColumnModuleKelas    ]);
    ?>
    <div class="row">
        <h4>ModuleMataPelajaran<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMataPelajaran = [
        ['attribute' => 'id', 'visible' => false],
        'nama_mapel',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->kodeMapel,
        'attributes' => $gridColumnModuleMataPelajaran    ]);
    ?>
</div>
