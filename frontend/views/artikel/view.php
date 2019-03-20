<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->judul;
$this->params['breadcrumbs'][] = [ 'label' => "Artikel", 'url'=>['/artikel'] ];
$this->params['breadcrumbs'][] = ['label'=>$model->beritaKategori->nama, 'url' => Url::to(['index','kategori'=>$model->beritaKategori->id])];

?>
<div class="site-artikel-view-<?= $model->id ?>">
	<div class="container-fluid">
		<?= Html::img(Url::to("@web/uploaded/berita/".$model->gambar)) ?>
		<?= $model->isi ?>
	</div>
</div>