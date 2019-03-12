<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleJadwal */

$this->title = 'Tambah Jadwal';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jadwal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
