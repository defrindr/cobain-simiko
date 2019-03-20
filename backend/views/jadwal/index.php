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

$hari = [
    "Senin" => "Senin",
    "Selasa" => "Selasa",
    "Rabu" => "Rabu",
    "Kamis" => "Kamis",
    "Jum'at" => "Jum'at",
    "Sabtu" => "Sabtu",
];

$GuruAll = \common\models\ModuleGuru::find()->orderBy('id')->all();
$guru = [];
$kelasAll = \common\models\ModuleKelas::find()->orderBy('id')->all();
$kelas = [];
foreach ($GuruAll as $each) {
    $guru += [$each->id => $each->profile->nama];
}
foreach ($kelasAll as $each) {
    $kelas += [$each->id => $each->grade . " " . " " . $each->jurusan->nama . " " . $each->kelas];
}

// echo "<pre>";
// print_r($kelas);
// exit();

$jam = [
    "07.00" => "07.00",
    "07.40" => "07.40",
    "08.20" => "08.20",
    "09.00" => "09.00",
    "09.40" => "09.40",
    "10.20" => "10.20",
    "11.00" => "11.00",
    "11.40" => "11.40",
    "12.20" => "12.20",
    "13.00" => "13.00",
    "13.40" => "13.40",
    "14.20" => "14.20",
    "15.00" => "15.00"
];


?>
<div class="module-jadwal-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
                <p>
                <?= Html::a('Tambah Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
                <?php echo Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                </p>
            <div class="search-form" style="display:none">
                <?php echo  $this->render('_search', ['model' => $searchModel]); ?>
            </div>
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
                'hari',
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
