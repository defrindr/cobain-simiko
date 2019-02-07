<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleBank */

$this->title = 'Tambah Bank';
$this->params['breadcrumbs'][] = ['label' => 'Bank', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-bank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
