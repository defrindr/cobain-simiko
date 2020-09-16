<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Berita';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-index">
    <div class="container">
        <?php foreach ($models as $model) { ?>
        <div class="box">
            <div class="row">
                <div class="col-sm-3">
                    <?= $model->judul ?>
                </div>
                <div class="col-sm-9">
                    
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
