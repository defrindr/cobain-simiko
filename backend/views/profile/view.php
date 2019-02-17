<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;    

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = "Profil Saya";
$this->params['breadcrumbs'][] = ['label' => 'Profil saya', 'url' => ['index']];
?>
<div class="module-profile-view">
    
    <div class="row">
        <div class="col-sm-8">

            <div class="box box-danger">
                <div class="box-header">
                    <?php echo Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']); ?>
                    <?php echo "\n"; // echo Html::a('Delete', ['delete', 'id' => $model->user_id], ['class' => 'btn btn-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]);?>
                </div>
                <div class="box-body">
                    <?php 
                        $gridColumn = [
                            [
                                'attribute' => 'user.username',
                                'label' => 'User',
                            ],
                            'nama',
                            'tgl_lahir',
                            'tempat_lahir',
                            'bio:ntext',
                            'no_telp',
                            [
                                'attribute' => 'email',
                                'label' => 'Email',
                                'value' => function($model){
                                    $model = $model->user;
                                    return $model->email;
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
                <!-- end box body -->
            </div>
            <!-- end box -->
            
        </div>
        <!-- end col sm 8 -->
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-header">
                    <h4>Photo Thumbnail</h4>
                </div>
                <div class="box-body">
                    <?php 
                    if(file_exists(Url::to(['@webroot/uploaded/img-profil/']))) {
                        echo Html::img('@webroot',['class'=>'img img-responsive']);
                    } else {
                        echo "Directori tidak ditemukan";
                    }

                     ?>
                </div>
                <!-- end box body -->
            </div>
            <!-- end box -->
            
        </div>
        <!-- end col sm 4 -->
    </div>
    <!-- end row -->



</div>
