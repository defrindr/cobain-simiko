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

    <!-- <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>SPP</th>
                    <th>Prakerin</th>
                    <th>Study Tour</th>
                    <th>Total</th>
                </tr>
                
            </thead>
            <tbody>
            
            </tbody>
        </table> -->
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
                        'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->asArray()->all(), 'user_id', 'user_id'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'Module siswa', 'id' => 'grid-module-spp-search-siswa_id']
                    ],
                    [
                        'attribute' => 'Kelas',
                        'value' => function($model){
                            return $model->siswa->kelas->grade ." ". $model->siswa->kelas->jurusan->nama . " ". $model->siswa->kelas->kelas;
                        }
                    ],
                    // [
                    //     'attribute' => 'bank_id',
                    //     'label' => 'Bank',
                    //     'value' => function($model){
                    //         return $model->bank->nama_bank;
                    //     },
                    //     'filterType' => GridView::FILTER_SELECT2,
                    //     'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleBank::find()->asArray()->all(), 'id', 'id'),
                    //     'filterWidgetOptions' => [
                    //         'pluginOptions' => ['allowClear' => true],
                    //     ],
                    //     'filterInputOptions' => ['placeholder' => 'Module bank', 'id' => 'grid-module-spp-search-bank_id']
                    // ],
                    'bulan',
                    'tahun',
                    // 'bukti_bayar',
                    [
                        'attribute' => 'spp',
                        'value' => function($model){
                            return "Rp. ".$model->spp;
                        }
                    ],
                    [
                        'attribute' => 'tabungan_prakerin',
                        'value' => function($model){
                            return "Rp. ".$model->tabungan_prakerin;
                        }
                    ],

                    [
                        'attribute' => 'tabungan_study_tour',
                        'value' => function($model){
                            return "Rp. ".$model->tabungan_study_tour;
                        }
                    ],

                    [
                        'attribute' => 'total',
                        'value' => function($model){
                            return "Rp. ".$model->total;
                        }
                    ],
                    // 'status',
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
