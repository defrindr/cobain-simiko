<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMataPelajaran */

$this->title = 'Tambah Mata Pelajaran';
$this->params['breadcrumbs'][] = ['label' => 'Mata Pelajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-mata-pelajaran-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
