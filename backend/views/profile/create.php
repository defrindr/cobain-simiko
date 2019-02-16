<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = 'Create Module Profile';
$this->params['breadcrumbs'][] = ['label' => 'Module Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
