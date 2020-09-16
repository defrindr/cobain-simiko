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
                <?php //Html::a('Tambah Jawaban', ['create'], ['class' => 'btn btn-success']) ?>
                <?php // Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
            </p>
            <div class="search-form" style="display:none">
                <?php // $this->render('_search', ['model' => $searchModel]); ?>
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
                            return $model->materiSoal->materi->judul." - ".$model->materiSoal->judul;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMateriSoal::find()->with(['materi'])->asArray()->all(), 'id', 'judul', 'materi.judul'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                                ],
                        'filterInputOptions' => ['placeholder' => 'materi soal', 'id' => 'grid-module-materi-soal-jawaban-search-materi_soal_id']
                    ],
                    [
                        'attribute' => 'siswa_id',
                        'label' => 'Siswa',
                        'value' => function($model){
                            return $model->siswa->profile->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->with(['profile'])->asArray()->all(), 'user_id', 'profile.nama'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'siswa', 'id' => 'grid-module-materi-soal-jawaban-search-siswa_id']
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
