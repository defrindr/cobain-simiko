<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleKelas */

$this->title = 'Tambah Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-kelas-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
