<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'Berita';
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
<div class="module-berita-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-success">
        <div class="box-header">
            <p>
                <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                <?php if(Yii::$app->user->can('Admin')){ ?>

                <?= Html::button('Restore data',['value' => Url::to(['berita/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
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
                [
                        'attribute' => 'berita_kategori_id',
                        'label' => 'Berita Kategori',
                        'value' => function($model){
                            if($model->beritaKategori != null){
                                return $model->beritaKategori->nama;
                            } else {
                                return "Data Kategori Terhapus";
                            }
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBeritaKategori::find()->asArray()->all(), 'id', 'nama'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module berita kategori', 'id' => 'grid-module-berita-search-berita_kategori_id']
                    ],
                'judul',
                [
                    'attribute'=>'isi',
                    'value' => function($dataProvider){
                        return StringHelper::truncateWords($dataProvider->isi,5,'...',null,false);
                    }
                ],
                'gambar',
                ['attribute' => 'lock', 'visible' => false],
                [
                    'class' => 'yii\grid\ActionColumn',
                ],
            ]; 
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsiveWrap' => false,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-berita']],
                'panel' => false,
                'responsiveWrap' => false,
            ]); ?>
        </div>
    </div>
    <!-- end box -->
</div>
