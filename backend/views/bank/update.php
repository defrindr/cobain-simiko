<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleBank */

$this->title = 'Ubah Bank: ' . ' ' . $model->nama_bank;
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_bank, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-bank-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
