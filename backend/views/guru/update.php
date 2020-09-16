<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */

$this->title = 'Ubah ' . ' ' . $model->profile->nama;
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->profile->nama, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="module-guru-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
