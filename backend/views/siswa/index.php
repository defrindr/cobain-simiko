<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Module Siswa';
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

?>
<div class="module-siswa-index">
    <div class="box-box-danger">
        <div class="box-header">
                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
                <p>
                    <?= Html::a('Create Module Siswa', ['create'], ['class' => 'btn btn-success']) ?>
                                <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
                            </p>
                            <div class="search-form" style="display:none">
                    <?=  $this->render('_search', ['model' => $searchModel]); ?>
                </div>
                        </div>
        <div class="box-body">
                        <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                                            [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function($model){                   
                    return $model->user->username;                   
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'username'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'User', 'id' => 'grid-module-siswa-search-user_id']
            ],
                                [
                'attribute' => 'kelas_id',
                'label' => 'Kelas',
                'value' => function($model){                   
                    return $model->kelas->id;                   
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleKelas::find()->asArray()->all(), 'id', 'id'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Module kelas', 'id' => 'grid-module-siswa-search-kelas_id']
            ],
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
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-siswa']],
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                    ],
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
