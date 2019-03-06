<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleBerita */

$this->title = 'Tambah Module Berita';
$this->params['breadcrumbs'][] = ['label' => 'Module Berita', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-berita-create">

    // <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
