<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Guru Restore';

$this->params['breadcrumbs'][] = $this->title;

?>

        <div class="box-body">
            <?php
            $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'Nama',
                'value' => function($model){
                    return $model->profile->nama;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleUser::find()->innerJoinWith(['profile'])->where(['role'=>20])->asArray()->all(), 'id', 'profile.nama'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Nama', 'id' => 'grid-module-guru-search-user_id']
            ],
            [
                'attribute' => 'mata_pelajaran_id',
                'label' => 'Mata Pelajaran',
                'value' => function($model){
                    return $model->mataPelajaran->nama_mapel;
                 },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->asArray()->all(), 'id', 'nama_mapel'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Mata pelajaran', 'id' => 'grid-module-guru-search-mata_pelajaran_id']
            ],
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{restore} {dpermanent}',
                'buttons' => [
                    'restore' => function($url,$model) {
                        return Html::a('Restore',
                            ['restore','id'=>$model->id],
                            ['class'=>'btn btn-info','data'=>['method'=>'post']]);
                    },
                    'dpermanent' => function($url,$model) {
                        return Html::a('Delete Permanent',
                            ['dpermanent','id'=>$model->id],
                            ['class'=>'btn btn-danger','data'=>['method'=>'post']]);
                    }
                ]
            ],
            ];
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-guru']],
                'panel' => false,
                'export' => false,
            ]); ?>
            
        </div>