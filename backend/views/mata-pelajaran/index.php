<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMataPelajaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


$this->title = 'Mata Pelajaran';
$this->params['breadcrumbs'][] = $this->title;

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    // 'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();

?>
<div class="module-mata-pelajaran-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-danger">
        <div class="box-header">
            <?php if(Yii::$app->user->can('Admin')) { ?>
            <p>
                <?= Html::button('Tambah', ['value' => Url::to(['/mata-pelajaran/create']), 'title' => 'Tambah', 'class' => 'btn btn-success showModalButton']) ?>
                <?= Html::button('Restore data', ['value' => Url::to(['/mata-pelajaran/data-restore']), 'title' => 'Restore data', 'class' => 'btn btn-warning showModalButton']) ?>
            </p>
            <?php } ?>
        </div>
        <div class="box-body">
            <?php 
            $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'nama_mapel',
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'visibleButtons' => [
                        'update' => function($model){
                            return Yii::$app->user->can('mapel.update', ['post' => $model]);
                        },
                        'delete' => function($model){
                            return Yii::$app->user->can('mapel.delete', ['post' => $model]);
                        },
                    ],
                    'buttons' => [
                        'update' => function($url,$model){
                            $id = $model->id;
                            return Html::button('<i class="glyphicon glyphicon-pencil"></i>', [ 'value' => Url::to(['/mata-pelajaran/update','id'=>$id]), 'title' => 'Update : '.$model->nama_mapel , 'class' => 'btn btn-actionColumn showModalButton']);
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
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-mata-pelajaran']],
                'panel' => false,
            ]); ?>
        </div>
    </div>



</div>
