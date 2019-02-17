<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleGuru */

$this->title = 'Tambah Guru';
$this->params['breadcrumbs'][] = ['label' => 'Guru', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-guru-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
