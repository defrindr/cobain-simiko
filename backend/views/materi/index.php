<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


// var_dump("@frontend");

$this->title = 'Materi';
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

$list_kelas = [];

$modelKelas = \common\models\ModuleKelas::find()->orderBy('id')->all();
foreach ($modelKelas as $kelas) {
    $list_kelas += [$kelas->id=>$kelas->grade." ".$kelas->jurusan->nama." ".$kelas->kelas];
}

$list_bab = [];
$modelBab = \common\models\ModuleMateriKategori::find()->orderBy('id')->all();
foreach ($modelBab as $bab) {
    $list_bab += [$bab->mataPelajaran->nama_mapel=>[$bab->id => $bab->nama]];
}

?>
<div class="module-materi-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?php if(Yii::$app->user->identity->role == 10 or Yii::$app->user->identity->role == 20){ ?>
                <?= Html::a('Tambah Materi', ['create'], ['class' => 'btn btn-success']) ?>
                <?php } ?>
                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                <?= Html::button('Restore data',['value' => Url::to(['/materi/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
            </p>
            <div class="search-form" style="display:none">
                <?=  $this->render('_search_siswa', ['model' => $searchModel]); ?>
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
                            return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_kelas,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module kelas', 'id' => 'grid-module-materi-search-kelas_id']
                    ],
                    [
                        'attribute' => 'materi_kategori_id',
                        'label' => 'Materi Kategori',
                        'value' => function($model){
                            return $model->materiKategori->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_bab,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module materi kategori', 'id' => 'grid-module-materi-search-materi_kategori_id']
                    ],
                    'judul',
                    'gambar',
                    [
                        'attribute' => 'komentar',
                        'value' => function($model){
                            return count($model->moduleMateriKomentars);
                        }
                    ],
                    // 'isi:ntext',
                    ['attribute' => 'lock', 'visible' => false],
                    [
                        'class' => 'yii\grid\ActionColumn',
                    ],
                ]; 
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => $gridColumn,
                    'responsiveWrap' => false,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi']],
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
