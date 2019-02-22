<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = 'Tambah Profile';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-profile-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
