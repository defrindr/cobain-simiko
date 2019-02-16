<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswa */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Module Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-siswa-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Siswa'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        [
            'attribute' => 'kelas.id',
            'label' => 'Kelas',
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'role',
        'online',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
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
    
    <div class="row">
<?php
if($providerModuleSpp->totalCount){
    $gridColumnModuleSpp = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
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
