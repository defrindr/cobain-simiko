<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleJam */

$this->title = 'Tambah Module Jam';
$this->params['breadcrumbs'][] = ['label' => 'Module Jam', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-jam-create">

    // <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
