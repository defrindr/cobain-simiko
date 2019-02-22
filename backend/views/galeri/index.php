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
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-success">
                    <div class="box-header">
                        <p>
                            <?= Html::button('Tambah',['value' => Url::to(['galeri/create-kategori']),'title' => 'Tambah Kategori', 'class' => 'showModalButton btn btn-success']); ?>
                            <?php if(Yii::$app->user->can('Admin')){ ?>

                            <?= Html::button('Restore data',['value' => Url::to(['galeri/data-restore-kategori']),'title' => 'restore data kategori', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
                            <?php } ?>
                        </p>
                    </div>
                    <!-- end box header -->
                    <div class="box-body">
                        <?php 
                        $gridColumn = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id', 'visible' => false],
                            'nama',
                            ['attribute' => 'lock', 'visible' => false],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                                'visibleButtons' => [
                                    'update' => function($model){
                                        return Yii::$app->user->can('galeri-kategori.update', ['post' => $model]);
                                    },
                                    'delete' => function($model){
                                        return Yii::$app->user->can('galeri-kategori.delete', ['post' => $model]);
                                    },
                                ],
                                'buttons' => [
                                    'update' => function($url,$model){
                                        $id = $model->id;
                                        return Html::button('<i class="glyphicon glyphicon-pencil"></i>',
                                            [
                                                'value' => Url::to(['galeri/update-kategori','id' => $id]),
                                                'title' => 'Update ', 'class'=> 'showModalButton btn btn-actionColumn',
                                            ]
                                        );
                                    },
                                    'delete' => function($url,$model){
                                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',['delete-kategori','id'=>$model->id],[
                                            'class' => 'btn btn-actionColumn',
                                            'data' => [
                                                'confirm' => 'Yakin ingin menghapus kategori '.$model->nama,
                                                'method' => 'post'
                                            ]
                                        ]);
                                    }
                                ]
                            ],
                        ]; 
                        ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderKategori,
                            'filterModel' => $searchModelKategori,
                            'columns' => $gridColumn,
                            'responsiveWrap' => false,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-galeri-kategori']],
                            'panel' => false,
                        ]); ?>
                    </div>
                </div>            
        </div>
        <div class="col-sm-8">
            <div class="box box-success">
                <div class="box-header">
                    <p>
                        <?php if(Yii::$app->user->can('Admin')) { ?>
                        <?= Html::button('Tambah',['value' => Url::to(['galeri/create']),'title' => 'Tambah', 'class' => 'showModalButton btn btn-success']); ?>
                        
                        <?= Html::button('Restore data',['value' => Url::to(['galeri/data-restore']),'title' => 'restore data galeri', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
                        <?php } ?>
                    </p>
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
                        // 'link',
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
                            'visibleButtons' => [
                                'update' => function($model){
                                    return Yii::$app->user->can('galeri.update', ['post' => $model]);
                                },
                                'delete' => function($model){
                                    return Yii::$app->user->can('galeri.delete', ['post' => $model]);
                                },
                            ],
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
                                            'title' => 'Update '.$model->judul,
                                            'class'=> 'btn btn-actionColumn showModalButton',
                                        ]
                                        );
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
                <!-- end body -->
            </div>
            
        </div>
    </div>


</div>