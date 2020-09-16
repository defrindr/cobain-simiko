<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriFile */

$this->title = 'Ubah Module Materi File: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Materi File', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-materi-file-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
