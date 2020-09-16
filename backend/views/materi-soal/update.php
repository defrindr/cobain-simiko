<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoal */

$this->title = 'Ubah Materi Soal: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Materi Soal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-materi-soal-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
