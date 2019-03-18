<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;


?>



        <div class="div col-sm-4">
            
            <div class="box box-success">
                <div class="box-header">
                    <p>
                        <?= Html::button('Tambah',['value' => Url::to(['berita/create-kategori']),'title' => 'Tambah', 'class' => 'showModalButton btn btn-success']); ?>
                        <?php // echo Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                        <?php if(Yii::$app->user->can('Admin')){ ?>

                        <?= Html::button('Restore data',['value' => Url::to(['/berita/data-restore-kategori']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
                        <?php } ?>
                    </p>
                    <div class="search-form" style="display:none">
                        <?php  // echo $this->render('_search', ['model' => $searchModelKategori]); ?>
                    </div>
                </div>

                <div class="box-body">
                    <?php 
                    $gridColumnKategori = [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id', 'visible' => false],
                        'nama',
                        ['attribute' => 'lock', 'visible' => false],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function($url,$model){
                                    $id = $model->id;
                                    return Html::button('<i class="glyphicon glyphicon-pencil"></i>',
                                        [
                                            'value' => Url::to(['berita/update-kategori','id' => $id]),
                                            'title' => 'Ubah '.$model->nama,
                                             'class'=> 'showModalButton btn btn-actionColumn',
                                        ]
                                    );
                                },
                                'delete' => function($url,$model){
                                    return Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                        ['delete-kategori','id'=>$model->id]
                                    );
                                }
                            ]
                        ],
                    ]; 
                    ?>
                    <?=  GridView::widget([
                        'dataProvider' => $dataProviderKategori,
                        'filterModel' => $searchModelKategori,
                        'responsiveWrap' => false,
                        'columns' => $gridColumnKategori,
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-berita-kategori']],
                        'panel' => false,
                        'responsiveWrap' => false,
                  ]); ?>
                </div>
            </div>
        </div>
