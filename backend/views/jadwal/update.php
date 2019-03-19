<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = 'Ubah Jadwal: ' . ' ' . $model->kelas->grade . " " . $model->kelas->jurusan->nama . " " . $model->kelas->kelas . " - ".$model->hari;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-jadwal-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
