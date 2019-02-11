<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleJurusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Jurusan';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    /*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();

?>
<div class="module-jurusan-index">
    <div class="box box-danger">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?php if(Yii::$app->user->can('jurusan.create')){ ?>
                <?= Html::button('Tambah',['value' => Url::to(['jurusan/create']),'title' => 'Tambah', 'class' => 'showModalButton btn btn-success']); ?>
                <?php } ?>
                <?php if(Yii::$app->user->can('Admin')){ ?>
                <?= Html::button('Restore data',['value' => Url::to(['jurusan/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
            <?php } ?>
            </p>
            <div class="search-form" style="display:none">
                <?=  $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <!-- end box header -->
        <div class="box-body">
            <?php 
            $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'nama',
                'kepala_jurusan',
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'visibleButtons' => [
                        'update' => function($model){
                            return Yii::$app->user->can('jurusan.update', ['post' => $model]);
                        },
                        'delete' => function($model){
                            return Yii::$app->user->can('jurusan.delete', ['post' => $model]);
                        },
                    ],
                    'buttons' => [
                        'update' => function($url,$model){
                            $id = $model->id;
                            return Html::button('<i class="glyphicon glyphicon-pencil"></i>',[
                                'value' => Url::to(['jurusan/update','id'=>$id]),
                                'title' => 'Update '.$model->nama,
                                'class' => 'showModalButton btn btn-actionColumn'
                            ]);
                        },
                    ],
                ],
            ]; 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jurusan']],
                'panel' => false,
            ]); ?>
        </div>
        <!-- end box body -->
    </div>

</div>
