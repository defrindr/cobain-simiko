<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label'=>$model->beritaKategori->nama,'url'=>['/artikel']];

?>
<div class="site-artikel-view-<?= $model->id ?>">
	<div class="container">
		<h1><?= Html::encode($model->judul)?></h1>
		<div class="container-fluid">
			<?= $model->isi ?>
		</div>
	</div>
</div>