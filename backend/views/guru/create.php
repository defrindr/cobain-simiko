<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */

$this->title = 'Create Module Guru';
$this->params['breadcrumbs'][] = ['label' => 'Module Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-guru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
