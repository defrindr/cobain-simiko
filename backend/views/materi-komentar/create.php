<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriKomentar */

$this->title = 'Tambah Module Materi Komentar';
$this->params['breadcrumbs'][] = ['label' => 'Module Materi Komentar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-komentar-create">

    // <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
