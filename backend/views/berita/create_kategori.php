<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleBeritaKategori */

$this->title = 'Tambah Berita Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Berita Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-kategori-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
