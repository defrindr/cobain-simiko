<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriSoalJawabanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Materi Soal Jawaban';
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
<div class="module-materi-soal-jawaban-index">
    <div class="box box-success">
        <div class="box-header">
                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
                <p>
                    <?= Html::a('Tambah Module Materi Soal Jawaban', ['create'], ['class' => 'btn btn-success']) ?>
                                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                            </p>
                            <div class="search-form" style="display:none">
                    <?=  $this->render('_search', ['model' => $searchModel]); ?>
                </div>
                        </div>
        <div class="box-body">
                        <?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    [
                        'attribute' => 'materi_soal_id',
                        'label' => 'Materi Soal',
                        'value' => function($model){
                            return $model->materiSoal->id;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateriSoal::find()->asArray()->all(), 'id', 'id'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                                ],
                        'filterInputOptions' => ['placeholder' => 'Module materi soal', 'id' => 'grid-module-materi-soal-jawaban-search-materi_soal_id']
                    ],
                    [
                        'attribute' => 'siswa_id',
                        'label' => 'Siswa',
                        'value' => function($model){
                            return $model->siswa->user_id;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->asArray()->all(), 'user_id', 'user_id'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module siswa', 'id' => 'grid-module-materi-soal-jawaban-search-siswa_id']
                    ],
                    'link',
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
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal-jawaban']],
                    'panel' => false,
                ]); ?>
        </div>
    </div>

</div>
