<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalFile */

$this->title = 'Tambah Materi Soal gambar';
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Soal gambar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-gambar-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
