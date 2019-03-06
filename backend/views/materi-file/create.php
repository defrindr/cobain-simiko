<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriFile */

$this->title = 'Tambah Module Materi File';
$this->params['breadcrumbs'][] = ['label' => 'Module Materi File', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-file-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
