<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleJurusan */

$this->title = 'Tambah Jurusan';
$this->params['breadcrumbs'][] = ['label' => 'Jurusan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jurusan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
