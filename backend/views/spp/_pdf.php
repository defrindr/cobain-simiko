<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */

$this->title = "Daftar Pembayar SPP Bulan";
$this->params['breadcrumbs'][] = ['label' => 'SPP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-spp-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
                $gridColumn = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
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
                        'filterInputOptions' => ['placeholder' => 'Module siswa', 'id' => 'grid-module-spp-search-siswa_id']
                    ],
                    [
                        'attribute' => 'bank_id',
                        'label' => 'Bank',
                        'value' => function($model){
                            return $model->bank->id;
                        },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->asArray()->all(), 'id', 'id'),
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
                    'status',
                    // ['attribute' => 'lock', 'visible' => false],
                    // [
                    //     'class' => 'yii\grid\ActionColumn',
                    // ],
                ]; 
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'columns' => $gridColumn,
                    'responsiveWrap' => false,
                    // 'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-spp']],
                ]); ?>
    </div>
</div>
