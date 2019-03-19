<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleSppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\tabs\TabsX;

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
        'filterInputOptions' => ['placeholder' => 'Siswa', 'id' => 'grid-module-spp-search-siswa_id']
    ],
    [
        'attribute' => 'bank_id',
        'label' => 'Bank',
        'value' => function($model){
            return $model->bank->nama_bank;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->asArray()->all(), 'id', 'nama_bank'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Bank', 'id' => 'grid-module-spp-search-bank_id']
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
        'template' => '{valid} {view} {update} {delete}',
        'visibleButtons' => [
            'valid' => function($model) {
                return \yii::$app->user->can('spp.validator',['post'=>$model]);
            }
        ],
        'buttons' => [
            'valid' => function($url,$model) {
                if($model->status == 0){
                    return Html::a('Validasi',['validasi','id'=>$model->id],
                        [
                        'class' => 'btn btn-primary btn-flat',
                        'method' =>'post'
                    ]);
                } else {
                    return Html::a('Unvalidasi',['unvalidasi','id'=>$model->id],
                        [
                        'class' => 'btn btn-danger btn-flat',
                        'method' =>'post'
                    ]);
                }
            }
        ]
    ],
];






$gridColumn2 = [
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
        'filterInputOptions' => ['placeholder' => 'Siswa', 'id' => 'grid-module-spp-search-siswa_id2']
    ],
    [
        'attribute' => 'bank_id',
        'label' => 'Bank',
        'value' => function($model){
            return $model->bank->nama_bank;
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->asArray()->all(), 'id', 'nama_bank'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Bank', 'id' => 'grid-module-spp-search-bank_id2']
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
        'template' => '{valid} {view}',
        'visibleButtons' => [
            'valid' => function($model) {
                return \yii::$app->user->can('spp.validator',['post'=>$model]);
            }
        ],
        'buttons' => [
            'valid' => function($url,$model) {
                if($model->status == 0){
                    return Html::a('Validasi',['validasi','id'=>$model->id],
                        [
                        'class' => 'btn btn-primary btn-flat',
                        'method' =>'post'
                    ]);
                } else {
                    return Html::a('Unvalidasi',['unvalidasi','id'=>$model->id],
                        [
                        'class' => 'btn btn-danger btn-flat',
                        'method' =>'post'
                    ]);
                }
            }
        ]
    ],
];

$content = GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumn,
    'responsiveWrap' => false,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-spp1']],
    'panel' => false,
]);


$content2 = GridView::widget([
    'dataProvider' => $dataProvider2,
    'filterModel' => $searchModel2,
    'columns' => $gridColumn2,
    'responsiveWrap' => false,
    'pjax' => true,
    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-spp2']],
    'panel' => false,
]);


$items = [
    [
        'label' => 'Belum Divalidasi',
        'content' => $content,
        'encode' => true
    ],
    [
        'label' => 'Sudah Divalidasi',
        'content' => $content2,
        'encode' => true
    ],

];

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











                 <?= TabsX::widget(['items' => $items,'encodeLabels' => false,'position' => TabsX::POS_ABOVE]) ?> 
        </div>
    </div>

</div>
