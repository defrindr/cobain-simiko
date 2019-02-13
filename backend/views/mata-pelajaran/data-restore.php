<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMataPelajaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


$this->title = 'Mata Pelajaran';
?>
<div class="module-mata-pelajaran-index">

            <?php 
            $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'nama_mapel',
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{restore}',
                    'buttons' => [
                        'restore' => function($url,$model){
                            return Html::a('Restore', ['restore', 'id' => $model->id], [
                                'class' => 'btn btn-info',
                                'data' => [
                                    'confirm' => 'Yakin ingin mengembalikan data ini ?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ]
                ],
            ]; 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'responsiveWrap' => false,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-mata-pelajaran']],
                'panel' => false,
            ]); ?>



</div>
