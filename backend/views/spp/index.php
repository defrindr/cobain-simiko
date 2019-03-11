<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;use yii\helpers\Url;


$this->title = 'Pembayaran SPP';
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

$siswa = \common\models\ModuleSiswa::find()->all();
$list_siswa = [];
foreach ($siswa as $people) {
    $tmp = array($people->user_id=>$people->profile->nama);
   $list_siswa+=$tmp;
}
// var_dump($list_siswa);
// exit();

?>
<div class="module-spp-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?php if(Yii::$app->user->can('spp.create')){ ?>
                <?= Html::a('Tambah Spp', ['create'], ['class' => 'btn btn-success']) ?>
                <?php } ?>
                <?= Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                <?php
                 if(Yii::$app->user->can('spp-manage')) {
                ?>
                <?= Html::a('Export Data',Url::to(['spp/pdf']),
                    [
                    'class' => 'btn btn-default'
                ]);
                ?>
                <?php } ?>
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
                        'attribute' => 'siswa_id',
                        'label' => 'Siswa',
                        'value' => function($model){
                            return $model->siswa->profile->nama;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => $list_siswa,
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module siswa', 'id' => 'grid-module-spp-search-siswa_id']
                    ],
                    [
                        'attribute' => 'bank_id',
                        'label' => 'Bank',
                        'value' => function($model){
                            return $model->bank->id;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->asArray()->all(), 'id', 'nama_bank'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module bank', 'id' => 'grid-module-spp-search-bank_id']
                    ],
                    'bulan',
                    'tahun',
                    'bukti_bayar',
                    'spp',
                    'tabungan_prakerin',
                    'tabungan_study_tour',
                    'total',
                    [
                        'attribute' => 'status',
                        'label' => 'Status',
                        'value' => function($model){
                            if($model->status==1){
                                return "Sudah Divalidasi";
                            }else {
                                return "Belum divalidasi";
                            }
                        }
                    ],
                    ['attribute' => 'lock', 'visible' => false],
                    [
                        'class' => 'yii\grid\ActionColumn',
                    ],
                ]; 
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => $gridColumn,
                    'responsiveWrap' => false,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-spp']],
                    'panel' => false,
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
                        ]) ,
                    ],
                ]); ?>
        </div>
    </div>

</div>
