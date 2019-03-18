<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;


?>
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