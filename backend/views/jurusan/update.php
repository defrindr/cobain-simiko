<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleJurusan */

$this->title = 'Ubah Jurusan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Jurusan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-jurusan-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
