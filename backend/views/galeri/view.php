<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleri */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Galeri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-galeri-view">
    <div class="container-fluid">
        <div class="row">
    <?php 
        $gridColumn = [
            ['attribute' => 'id', 'visible' => false],
            // [
            //     'attribute' => 'kategori0.id',
            //     'label' => 'Kategori',
            // ],
            [
                'attribute' => 'link',
                'format' => 'raw',
                'value' => function($model){
                    return '<span style="word-break:break-all">'.$model->link.'</span>';
                }
            ],
            'judul',
            'tahun',
            'uploaded_by',
            [
                'attribute' => 'uploaded_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s",$model->updated_at);
                }
            ],
            [
                'attribute' => 'Size',
                'value' => function($model){
                    list($w ,$h) = getimagesize(Url::to("@frontend")."/web/uploaded/galeri/".$model->link);
                    return $w." x ".$h;
                }
            ],
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $gridColumn,
        ]);
    ?>
        </div>
        <div class="row">
            <h4>Kategori</h4>
        </div>
        <?php 
        $gridColumnModuleGaleriKategori = [
            ['attribute' => 'id', 'visible' => false],
            'nama',
            ['attribute' => 'lock', 'visible' => false],
        ];
        echo DetailView::widget([
            'model' => $model->kategori0,
            'attributes' => $gridColumnModuleGaleriKategori,
        ]);
        ?>

    <div class="row">
        <h4>Preview Image</h4>
    </div>
    <?= Html::img(str_replace("/administrator","",Url::home())."/uploaded/galeri/".$model->link,['class'=>'img img-responsive','style'=>'margin:auto auto']) ?>

    </div>
</div>
