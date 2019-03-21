<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalJawaban */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Soal Jawaban', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-jawaban-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Materi Soal Jawaban'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'materiSoal.id',
            'label' => 'Materi Soal',
        ],
        [
            'attribute' => 'siswa.user_id',
            'label' => 'Siswa',
        ],
        'link',
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
        <h4>ModuleMateriSoal<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMateriSoal = [
        ['attribute' => 'id', 'visible' => false],
        'materi_id',
        'judul',
        'isi',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->materiSoal,
        'attributes' => $gridColumnModuleMateriSoal    ]);
    ?>
</div>
