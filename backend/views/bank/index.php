<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Bank';
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
<div class="module-bank-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box box-success">
        <div class="box-header">
            <p>
                <?= Html::button('Tambah', ['value'=>Url::to(['/bank/create']), 'title' => 'Tambah '.$this->title , 'class' => 'btn btn-success showModalButton']) ?>
                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                <?php if(Yii::$app->user->can('Admin')){ ?>

                <?= Html::button('Restore data',['value' => Url::to(['bank/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
                <?php } ?>
            </p>
            <div class="search-form" style="display:none">
                <?=  $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="box-body">
             <?php 
            $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                'no_rekening',
                'nama_bank',
                'atas_nama',
                [
                    'attribute' => 'gambar',
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::img(Url::base().'/uploaded/bank/'.$model->gambar,['style' => ['max-height'=>'120px','max-width' => '120px'] ,'class' => 'img img-responsive']);
                    }
                ],
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function($url,$model){
                            return Html::button('<i class="glyphicon glyphicon-pencil"></i>',
                                [
                                    'title' => 'Bank '.$model->nama_bank,
                                    'value' =>  Url::to(['bank/update','id'=>$model->id]),
                                    'class'=>'btn-actionColumn showModalButton'
                                ]
                            );
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

</div>
