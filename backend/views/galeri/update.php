<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleri */

$this->title = 'Update Module Galeri: ' . ' ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Module Galeri', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->link, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-galeri-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
