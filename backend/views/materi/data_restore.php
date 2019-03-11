<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = "Restore Materi";

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
    <div class="container-fluid">
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
                ['attribute' => 'lock', 'visible' => false],
                [
		            'class' => 'yii\grid\ActionColumn',
		            'template' => '{restore} {permDelete}',
		            'buttons' => [
		                'restore' => function($url,$model){
		                    if($model->getMateriKategori()->one()->deleted_by !== null){
		                        $id = $model->id;
		                        return Html::a('Restore', ['restore', 'id' => $model->id], [
		                            'class' => 'btn btn-info',
		                                'data' => [
		                                    'confirm' => 'Anda yakin ingin merestore data ini ?',
		                                    'method' => 'post',
		                                ],
		                            ]
		                        );
		                    } else {
		                        return Html::button('Restore', [
		                            'value' => '#',
		                            'class' => 'btn btn-disable',
		                            ]
		                        );
		                    }
		                },
		                'permDelete' => function($url,$model){
		                    $id = $model->id;
		                    return Html::a('Hard Delete', ['d-permanent', 'id' => $model->id], [
		                        'class' => 'btn btn-danger',
		                            'data' => [
		                                'confirm' => 'Anda yakin ingin menghapus permanen data ini ?',
		                                'method' => 'post',
		                            ],
		                        ]
		                    );
		                }
		            ],
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
