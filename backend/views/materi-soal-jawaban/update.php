<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalJawaban */

$this->title = 'Ubah Module Materi Soal Jawaban: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Soal Jawaban', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-materi-soal-jawaban-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
