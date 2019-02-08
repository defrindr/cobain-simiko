<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleri */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Galeri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-galeri-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Galeri'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'kategori0.id',
            'label' => 'Kategori',
        ],
        'link',
        'judul',
        'tahun',
        'uploaded_by',
        'uploaded_at',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleGaleriKategori<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleGaleriKategori = [
        ['attribute' => 'id', 'visible' => false],
        'nama',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->kategori0,
        'attributes' => $gridColumnModuleGaleriKategori    ]);
    ?>
</div>
