<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleGaleriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Galeri';
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
<div class="module-galeri-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-danger">
        <div class="box-header">
            <p>
                <?= Html::button('Tambah',['value' => Url::to(['galeri/create']),'title' => 'Tambah', 'class' => 'showModalButton btn btn-success']); ?>
                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
            </p>
            <div class="search-form" style="display:none">
                <?=  $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <!-- end header -->
        <div class="box-body">
            <?php 
            $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'id', 'visible' => false],
                [
                        'attribute' => 'kategori',
                        'label' => 'Kategori',
                        'value' => function($model){
                            return $model->kategori0->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleGaleriKategori::find()->asArray()->all(), 'id', 'nama'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module galeri kategori', 'id' => 'grid-module-galeri-search-kategori']
                    ],
                'link',
                'judul',
                'tahun',
                [
                    'attribute' => 'preview',
                    'format' => 'html',
                    'value' => function($model){
                        $path = Url::base()."/uploaded/galeri/".$model->link;
                        return Html::img($path,['width' => '70px']);
                    }
                ],
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'headerOptions' => ['width' => '20%','class' => 'activity-view-link'],
                    'contentOptions' => ['class' => 'padding-left-5px text-wrap'],
                    'buttons' => [
                        'view' => function($url,$model){
                            $id = $model->id;
                            return Html::button('<i class="glyphicon glyphicon-eye-open"></i>',
                                [
                                    'value' => Url::to(['galeri/view','id' => $id]),
                                    'title' => 'View', 'class'=> 'showModalButton btn btn-actionColumn',
                                ]
                                );
                        },
                        'update' => function($url,$model){
                            $id = $model->id;
                            return Html::button('<i class="glyphicon glyphicon-pencil"></i>',
                                [
                                    'value' => Url::to(['galeri/update','id' => $id]),
                                    'title' => 'View', 'class'=> 'showModalButton btn btn-actionColumn',
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
                'responsiveWrap' => false,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-galeri']],
                'panel' => false,
            ]); ?>
        </div>
        <!-- end body -->
    </div>

</div>
