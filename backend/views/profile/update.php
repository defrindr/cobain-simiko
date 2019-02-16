<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = 'Update Module Profile: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Module Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
