<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = $model->materiSoal->judul;
$this->params['breadcrumbs'][] = ['label' => 'Jawaban', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-jawaban-view">
    <div class="box box-danger">
        <div class="box-header">
        </div>

        <div class="box-body">
            <tr>
                <td>Preview</td>
                
            </tr>
            <iframe style="box-shadow: 10px 10px 10px #444" src="<?= Url::to("@web/uploaded/materi-soal-jawaban/".$model->link) ?>" frameborder="0" width="100%"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h4>Siswa</h4>
                </div>
                <div class="box-body">
                    <?php 
                    $gridColumnModuleSiswa = [
                        'user_id',
                        'kelas_id',
                        ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo DetailView::widget([
                        'model' => $model->siswa,
                        'attributes' => $gridColumnModuleSiswa    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h4>Soal<?= ' '. Html::encode($this->title) ?></h4>
                </div>
                <div class="box-body">
                    <?php 
                    $gridColumnModuleMateriSoal = [
                        ['attribute' => 'id', 'visible' => false],
                        [
                            'attribute' => 'materi_id',
                            'label' => 'Materi',
                            'value' => function($model){
                                return $model->materi->judul;
                            }
                        ],
                        'judul',
                        'isi',
                        ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo DetailView::widget([
                        'model' => $model->materiSoal,
                        'attributes' => $gridColumnModuleMateriSoal    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
