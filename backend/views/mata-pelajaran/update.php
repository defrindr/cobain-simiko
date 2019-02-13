<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMataPelajaran */

$this->title = 'Ubah Mata Pelajaran: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mata Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="module-mata-pelajaran-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
