<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleGaleriKategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Galeri Kategori';
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
<div class="module-galeri-kategori-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-danger">
        <div class="box-header">
            <p>
                <?= Html::button('Tambah',['value' => Url::to(['galeri-kategori/create']),'title' => 'Tambah', 'class' => 'showModalButton btn btn-success']); ?>
                <!-- <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?> -->
                <?php if(Yii::$app->user->can('Admin')){ ?>

                <?= Html::button('Restore data',['value' => Url::to(['galeri-kategori/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
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
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function($url,$model){
                            $id = $model->id;
                            return Html::button('<i class="glyphicon glyphicon-eye-open"></i>',
                                [
                                    'value' => Url::to(['galeri-kategori/update','id' => $id]),
                                    'title' => 'Update ', 'class'=> 'showModalButton btn btn-actionColumn',
                                ]
                            );
                        },
                    ]                    
                ],
            ]; 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-galeri-kategori']],
                'panel' => false,
            ]); ?>
        </div>
    </div>

</div>
