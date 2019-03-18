<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;


 ?>


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
                                            'title' => $model->judul, 'class'=> 'showModalButton btn btn-actionColumn',
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
