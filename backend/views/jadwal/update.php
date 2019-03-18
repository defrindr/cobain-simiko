<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = 'Ubah Jadwal : '.$model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas." Jam ".$model->jam_mulai."-".$model->jam_selesai;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas." Jam ".$model->jam_mulai."-".$model->jam_selesai, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-jadwal-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
