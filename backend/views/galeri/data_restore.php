<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleGaleriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Galeri restore';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="module-galeri-index">
    <div class="container-fluid">
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
                'template' => '{restore} {del-permanent}',
                'headerOptions' => ['width' => '20%','class' => 'activity-view-link'],
                'contentOptions' => ['class' => 'padding-left-5px text-wrap'],
                'buttons' => [
                    'restore' => function($url,$model){
                        $id = $model->id;
                        return Html::a('Restore', ['restore', 'id' => $model->id], [
                            'class' => 'btn btn-info',
                                'data' => [
                                    'confirm' => 'Anda yakin ingin merestore data ini ?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                    'del-permanent' => function($url,$model){
                        return html::a('Delete permanent',['del-permanent','id'=>$model->id],[
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Yakin ingin menghapus Permanent item ini ?',
                                'method' => 'post'
                            ]
                        ]);
                    }
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



</div>
