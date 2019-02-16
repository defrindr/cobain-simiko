<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ModuleSiswa */

$this->title = 'Tambah Siswa';
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-siswa-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
