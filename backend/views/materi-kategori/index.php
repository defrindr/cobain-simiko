<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriKategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


$this->title = 'Materi Kategori';
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
<div class="module-materi-kategori-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::button('Tambah Materi Kategori', ['value'=>Url::to(['create']), 'class' => 'btn btn-success showModalButton']) ?>
            </p>
        </div>
        <div class="box-body">
            <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'mata_pelajaran_id',
                        'label' => 'Mata Pelajaran',
                        'value' => function($model){
                            return $model->mataPelajaran->nama_mapel;
                            },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->asArray()->all(), 'id', 'nama_mapel'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Mata pelajaran', 'id' => 'grid-module-materi-kategori-search-mata_pelajaran_id']
                    ],
                    'nama',
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
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-kategori']],
                    'panel' => false,
                    'export' => false,
                ]); ?>
        </div>
    </div>

</div>
