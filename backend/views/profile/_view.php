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


?>
<div class="module-profile-view">
    
    <div class="container-fluid">
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
                ['attribute' => 'lock', 'visible' => false],
            ];
            echo DetailView::widget([
                'model' => $model,
                'attributes' => $gridColumn
            ]);
        ?>
            <?php 
            if($model->avatar == ""){
                echo "<center>Avatar kosong</center>";
            } else {
                if(file_exists(Yii::$app->basePath.'/web/uploaded/img-profil')) 
                {
                    if(file_exists(Yii::$app->basePath.'/web/uploaded/img-profil/'.$model->avatar))
                    {
                        echo "<center>".Html::img(Url::to(['/uploaded/img-profil/'.$model->avatar]),['class'=>'img img-responsive'])."</center>";
                    } else {
                         echo "<center>Gambar tidak ditemukan</center>";
                    }
                } else {
                    echo "<center>Directori tidak ditemukan</center>";
                }
            }
             ?>
    </div>
    <!-- end row -->



</div>
