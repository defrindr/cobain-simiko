<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = "Profil Saya";
$this->params['breadcrumbs'][] = ['label' => 'Profil saya', 'url' => ['index']];

yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();


if(Yii::$app->user->identity->role == 30){
    $anu = [
        'attribute' => 'Kelas',
        'value' => function($model){
            return $model->siswa->kelas->grade." ".$model->siswa->kelas->jurusan->nama." ".$model->siswa->kelas->kelas;
        }
    ];
}

?>
<div class="module-profile-view">
    
    <div class="row">
        <div class="col-sm-8">

            <div class="box box-danger">
                <div class="box-header">
                    <?php echo Html::button('Ubah ', [
                        'value' => Url::to(['update', 'id' => $model->user_id]) ,
                         'class' => 'btn btn-primary showModalButton',
                         'title' => 'Ubah Profile'
                     ]); 
                     ?>
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
                            [
                                'attribute' => 'tgl_lahir',
                                'value' => function($model){
                                    if(!empty($model->tgl_lahir)){
                                        return date('d M Y',$model->tgl_lahir);
                                    }else {
                                        return "";
                                    }
                                    
                                }
                            ],
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
                            
                            [
                                'attribute' => 'Login Terakhir',
                                'value' => function($model){
                                    return date('Y-m-d H:i:s',$model->user->last_login);
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
                    <center>
                        <?php 
                        if($model->avatar == ""){
                            echo "Avatar kosong";
                        } else {
                            if(file_exists(Yii::$app->basePath.'/web/uploaded/img-profil')) 
                            {
                                if(file_exists(Yii::$app->basePath.'/web/uploaded/img-profil/'.$model->avatar))
                                {
                                    echo Html::img(Url::to(['/uploaded/img-profil/'.$model->avatar]),['class'=>'img img-responsive']);
                                } else {
                                     echo "Gambar tidak ditemukan";
                                }
                            } else {
                                echo "Directori tidak ditemukan";
                            }
                        }
                         ?>
                    </center>
                </div>
                <!-- end box body -->
            </div>
            <!-- end box -->
            
        </div>
        <!-- end col sm 4 -->
    </div>
    <!-- end row -->



</div>
