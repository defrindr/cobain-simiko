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
'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
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
                <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
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
                            return $model->kategori0->id;                   
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleGaleriKategori::find()->asArray()->all(), 'id', 'id'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module galeri kategori', 'id' => 'grid-module-galeri-search-kategori']
                    ],
                'link',
                'judul',
                'tahun',
                'uploaded_by',
                'uploaded_at',
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                ],
            ]; 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-galeri']],
                'panel' => false,
            ]); ?>
        </div>
        <!-- end body -->
    </div>

</div>
