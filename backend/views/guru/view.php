<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */
$this->title = $model->profile->nama;
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-guru-view">
    <?php if($providerModuleKelas->totalCount > 0){ ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="box box-success">
                <div class="box-header">
                    <?php if(Yii::$app->user->can('Admin')){?>
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary',
                            'data' => [
                                'method'=>'post',
                            ],
                        ]) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                        ],
                        ])
                        ?>

                    <?php } ?>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumn = [
                    [
                    'attribute' => 'user.username',
                    'label' => 'Nama',
                    'value' => function($model){
                    return $model->profile->nama;
                    }
                    ],
                    [
                    'attribute' => 'email',
                    'label' => 'Email',
                    'value' => function($model) {
                    return $model->user->email;
                    }
                    ],
                    [
                    'attribute' => 'mataPelajaran.id',
                    'label' => 'Mata Pelajaran',
                    'value' => function($model){
                    return $model->mataPelajaran->nama_mapel;
                    }
                    ],
                    ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            
            <?php
            if($providerModuleKelas->totalCount){
            echo '
            <div class="box box-success">
                <div class="box-header">
                    <h4>Kelas</h4>
                </div>
                <div class="box-body">';
                    $gridColumnModuleKelas = [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                    'grade',
                    [
                    'attribute' => 'jurusan.id',
                    'label' => 'Jurusan',
                    'value' => function($model){
                    return $model->jurusan->nama;
                    }
                    ],
                    'kelas',
                    'tahun',
                    ['attribute' => 'lock', 'visible' => false],
                    ];
                    echo Gridview::widget([
                    'dataProvider' => $providerModuleKelas,
                    'pjax' => true,
                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-kelas']],
                    'panel' => false,
                    'columns' => $gridColumnModuleKelas
                    ]);
                    echo '
                </div>
            </div>
            ';
            }
            ?>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="box box-success">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary',
            'data' => [
                'method'=>'post',
            ],
        ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
        ],
        ])
        ?>
    </div>
    <div class="box-body">
        <?php
        $gridColumn = [
        [
        'attribute' => 'user.username',
        'label' => 'Nama',
        'value' => function($model){
        return $model->profile->nama;
        }
        ],
        [
        'attribute' => 'email',
        'label' => 'Email',
        'value' => function($model) {
        return $model->user->email;
        }
        ],
        [
        'attribute' => 'mataPelajaran.id',
        'label' => 'Mata Pelajaran',
        'value' => function($model){
        return $model->mataPelajaran->nama_mapel;
        }
        ],
        ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
        ]);
        ?>
    </div>
</div>
<?php } ?>
</div>