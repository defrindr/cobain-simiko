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



/**
 * List Kelas
 *
 * Mengambil data semua kelas dan meletakkannya dalam array
 * 
 * @return array
 */

$kelas = \common\models\ModuleKelas::find()->orderBy('kelas')->all();
$list_kelas = [];
foreach ($kelas as $each) {
    $list_kelas += [$each->id=>$each->grade." ".$each->jurusan->nama." ".$each->kelas];
}


/**
 * List Jam
 * @var Array
 */
$list_jam = [
    '07.00'=>'07.00',
    '07.40'=>'07.40',
    '08.20'=>'08.20',
    '10.00'=>'10.00',
    '10.40'=>'10.40',
    '11.20'=>'11.20',
    '12.00'=>'12.00',
    '12.40'=>'12.40',
    '13.20'=>'13.20',
    '14.20'=>'14.20',
    '15.00'=>'15.00',
    '15.40'=>'15.40'
];


/**
 * List Hari
 * @var Array
 */
$list_hari = [
    'senin' => 'senin',
    'selasa' => 'selasa',
    'rabu' => 'rabu',
    'kamis' => 'kamis',
    'jum\'at' => 'jum\'at',
    'sabtu' => 'sabtu'
];

/**
 * List Guru
 *
 * Mengambil data semua guru dan meletakkannya dalam array
 * 
 * @return array
 */

$guru =  \common\models\ModuleGuru::find()->all();
$list_guru = [];
foreach ($guru as $each) {
    $tmp = [$each->mataPelajaran->nama_mapel=>[$each->id=>$each->profile->nama]];
    $list_guru = array_merge_recursive($list_guru,$tmp);
}


?>
<div class="module-jadwal-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <p>
                    <?= Html::a('Tambah Jadwal', ['create'], ['class' => 'btn btn-success']) ?>
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
                            return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_kelas,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih kelas', 'id' => 'grid-module-jadwal-search-kelas_id']
                    ],
                    [
                        'attribute' => 'kode_guru',
                        'label' => 'Guru',
                        'value' => function($model){
                            return $model->kodeGuru->profile->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_guru,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih Guru', 'id' => 'grid-module-jadwal-search-kode_guru']
                    ],
                    [
                        'attribute'=>'hari',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_hari,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih hari', 'id' => 'grid-module-jadwal-search-hari']
                    ],
                    [
                        'attribute'=>'jam_mulai',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_jam,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih jam mulai', 'id' => 'grid-module-jadwal-search-jam-mulai']
                    ],
                    [
                        'attribute'=>'jam_selesai',
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_jam,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Pilih jam selesai', 'id' => 'grid-module-jadwal-search-jam-selesai']
                    ],
                    [
                        'attribute' => 'mata-pelajaran',
                        'label' => 'Mata Pelajaran',
                        'value' => function($model){
                            return $model->kodeGuru->mataPelajaran->nama_mapel;
                        }
                    ],
                    ['attribute' => 'lock', 'visible' => false],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function($url,$model) {
                                return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                                    ['update','id'=>$model->id],
                                    ['data'=>['method'=>'post']]);
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
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-jadwal']],
                    'panel' => false,
                    'export' => false,
                    // your toolbar can include the additional full export menu
                    'toolbar' => [
                        '{export}',
                        ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumn,
                            'target' => ExportMenu::TARGET_BLANK,
                            'fontAwesome' => true,
                            'dropdownOptions' => [
                                'label' => 'Full',
                                'class' => 'btn btn-default',
                                'itemsBefore' => [
                                    '<li class="dropdown-header">Export All Data</li>',
                                ],
                            ],
                                        'exportConfig' => [
                                ExportMenu::FORMAT_PDF => false
                            ]
                                    ]) ,
                    ],
                ]); ?>
        </div>
    </div>

</div>
