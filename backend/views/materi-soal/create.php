<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoal */

$this->title = 'Tambah Materi Soal';
$this->params['breadcrumbs'][] = ['label' => 'Materi Soal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
