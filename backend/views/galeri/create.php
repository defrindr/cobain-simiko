<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleGaleri */

$this->title = 'Create Module Galeri';
$this->params['breadcrumbs'][] = ['label' => 'Module Galeri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-galeri-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
