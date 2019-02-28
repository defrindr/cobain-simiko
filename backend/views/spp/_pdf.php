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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'siswa.user_id',
                'label' => 'Siswa'
            ],
        [
                'attribute' => 'bank.id',
                'label' => 'Bank'
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
</div>
