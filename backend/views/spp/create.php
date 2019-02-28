<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleSpp */

$this->title = 'Tambah Spp';
$this->params['breadcrumbs'][] = ['label' => 'Spp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-spp-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
