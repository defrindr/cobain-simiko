<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleriKategori */

$this->title = 'Tambah Galeri Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Galeri Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-galeri-kategori-create">

    <?= $this->render('_form_kategori', [
        'model' => $model,
    ]) ?>

</div>
