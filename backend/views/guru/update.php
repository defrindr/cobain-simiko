<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */

$this->title = 'Update Module Guru: ' . ' ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Module Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-guru-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
