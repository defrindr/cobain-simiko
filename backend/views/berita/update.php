<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */

$this->title = 'Ubah Berita: ' . ' ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->judul, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-berita-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
