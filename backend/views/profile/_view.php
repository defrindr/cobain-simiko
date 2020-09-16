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
                            [
                                'attribute'=>'jenis_kelamin',
                                'value' => function($model) {
                                    return ($model->jenis_kelamin=='L') ? "Laki-Laki" : "Perempuan";
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
                    <h4>Photo Thumbnail</h4>
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
