<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = 'Ubah Jadwal: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-jadwal-update">
    <?= $this->render('_form', [
        'model' => $model,
        'guru'  => $guru,
        'kelas' => $kelas,
        'hari'  => $hari
    ]) ?>

</div>
