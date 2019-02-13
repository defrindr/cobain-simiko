<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleJurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Jurusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jurusan-index">
    <div class="container-fluid">
        <?php 
        $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'nama',
            'kepala_jurusan',
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{restore}',
                'buttons' => [
                    'restore' => function($url,$model){
                            $id = $model->id;
                            return Html::a('Restore', ['restore', 'id' => $model->id], [
                                'class' => 'btn btn-info',
                                    'data' => [
                                        'confirm' => 'Anda yakin ingin merestore data ini ?',
                                        'method' => 'post',
                                    ],
                                ]
                            );
                        },
                ],
            ],
        ]; 
        ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumn,
            'responsiveWrap' => false,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jurusan']],
            'panel' => false,
        ]); ?>
    </div>

</div>
