<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswa */

$this->title = 'Ubah Siswa: ' . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="module-siswa-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
