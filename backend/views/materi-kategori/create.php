<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriKategori */

$this->title = 'Tambah Materi Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Materi Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-kategori-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
