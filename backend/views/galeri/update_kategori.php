<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleriKategori */

$this->title = 'Ubah Galeri Kategori: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Galeri Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-galeri-kategori-update">

    <?= $this->render('_form_kategori', [
        'model' => $model,
    ]) ?>

</div>
