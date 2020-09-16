<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jadwal-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Jadwal'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'mapel.id',
            'label' => 'Mapel',
        ],
        [
            'attribute' => 'kodeGuru.id',
            'label' => 'Kode Guru',
        ],
        [
            'attribute' => 'jam.id',
            'label' => 'Jam',
        ],
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
        <h4>ModuleMataPelajaran<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMataPelajaran = [
        ['attribute' => 'id', 'visible' => false],
        'nama_mapel',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->mapel,
        'attributes' => $gridColumnModuleMataPelajaran    ]);
    ?>
    <div class="row">
        <h4>ModuleGuru<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleGuru = [
        ['attribute' => 'id', 'visible' => false],
        'user_id',
        'mata_pelajaran_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->kodeGuru,
        'attributes' => $gridColumnModuleGuru    ]);
    ?>
    <div class="row">
        <h4>ModuleJam<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleJam = [
        ['attribute' => 'id', 'visible' => false],
        'jam',
    ];
    echo DetailView::widget([
        'model' => $model->jam,
        'attributes' => $gridColumnModuleJam    ]);
    ?>
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
</div>
