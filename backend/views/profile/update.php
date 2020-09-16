<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = 'Ubah Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ubah';
?>
<div class="module-profile-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
