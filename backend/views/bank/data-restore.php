<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Bank restore';
?>
<div class="module-bank-index">
    <div class="container-fluid">
         <?php 
        $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'no_rekening',
            'nama_bank',
            'atas_nama',
            'gambar',
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{restore} {dpermanent}',
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
                    'dpermanent' => function($url,$model){
                        return Html::a('Hard Delete',['dpermanent','id'=>$model->id],[
                            'class'=>'btn btn-danger',
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'Anda Yakin ingin Menghapus permanen data ini ?'
                            ]
                        ]);
                    }
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
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-bank']],
            'panel' => false,
        ]); ?>
        
    </div>

</div>
