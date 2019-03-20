<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalFile */

$this->title = 'Ubah Materi Soal Gambar: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Materi Soal Gambar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-materi-soal-file-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
