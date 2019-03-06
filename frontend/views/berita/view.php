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
        <div class="col-sm-9">
            <h2><?= 'Module Berita'.' '. Html::encode($this->title) ?></h2>
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
    <div class="row">
        <h4>ModuleBeritaKategori<?= ' '. Html::encode($this->title) ?></h4>
    </div>
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
