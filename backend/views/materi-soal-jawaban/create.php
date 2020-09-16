<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoalJawaban */

$this->title = 'Tambah Module Materi Soal Jawaban';
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Soal Jawaban', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-jawaban-create">

    // <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
