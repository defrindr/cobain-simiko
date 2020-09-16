<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */

$this->title = 'Ubah Kelas: ' . ' ' . $model->grade.' '.$model->getJurusan()->one()->nama.' '.$model->kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->grade.' '.$model->getJurusan()->one()->nama.' '.$model->kelas, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="module-kelas-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
