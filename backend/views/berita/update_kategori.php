<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBeritaKategori */

$this->title = 'Ubah Berita Kategori: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Berita Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-berita-kategori-update">

    <?= $this->render('_form_kategori', [
        'model' => $model,
    ]) ?>

</div>
