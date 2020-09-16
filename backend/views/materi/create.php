<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateri */

$this->title = 'Tambah Materi';
$this->params['breadcrumbs'][] = ['label' => 'Materi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
