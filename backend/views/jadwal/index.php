<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleJadwalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


$this->title = 'Jadwal';
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
<div class="module-jadwal-index">
    <div class="box box-success">
        <div class="box-header">
                <p>
                <?= Html::a('Tambah Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Export PDF',['pdf'],['class'=>'btn btn-default']) ?>
                </p>
        </div>
        <div class="box-body">
            <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'kelas_id',
                        'label' => 'Kelas',
                        'value' => function($model){
                            return $model->kelas->grade." ". $model->kelas->jurusan->nama . " " . $model->kelas->kelas;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $kelas,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'kelas', 'id' => 'grid-module-jadwal-search-kelas_id']
                    ],
                    [
                        'attribute' => 'mapel_id',
                        'label' => 'Mapel',
                        'value' => function($model){
                            return $model->mapel->nama_mapel;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->asArray()->all(), 'id', 'nama_mapel'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Mata pelajaran', 'id' => 'grid-module-jadwal-search-mapel_id']
                    ],
                    [
                        'attribute' => 'kode_guru',
                        'label' => 'Kode Guru',
                        'value' => function($model){
                            return $model->kodeGuru->profile->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' =>  $guru,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Guru', 'id' => 'grid-module-jadwal-search-kode_guru']
                    ],
                    [
                        'attribute' => 'jam_id',
                        'label' => 'Jam',
                        'value' => function($model){
                            return $model->jam->jam;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJam::find()->asArray()->all(), 'id', 'jam'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Jam', 'id' => 'grid-module-jadwal-search-jam_id']
                    ],
                    [
                        'attribute' => 'hari',
                        'label' => 'Hari',
                        'value' => function ($model) {
                            return $model->hari;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $hari,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Hari', 'id' => 'grid-module-jadwal-search-hari']
                    ],
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
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jadwal']],
                    'panel' => false,
                    'export' => false,
                ]); ?>
        </div>
    </div>

</div>
