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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'kelas.id',
                'label' => 'Kelas'
            ],
        [
                'attribute' => 'kodeGuru.id',
                'label' => 'Kode Guru'
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
</div>
