<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->judul;
$this->params['breadcrumbs'][] = [ 'label' => "Artikel", 'url'=>['/artikel'] ];
$this->params['breadcrumbs'][] = ['label'=>$model->beritaKategori->nama, 'url' => Url::to(['index','kategori'=>$model->beritaKategori->id])];

// var_dump((strlen($model->gambar) > 1) and file_exists(Url::to("@webroot/uploaded/berita/".$model->gambar)));
// exit();
?>
<div class="site-artikel-view-<?= $model->id ?>">
	<div class="container-fluid">
		<?php if((strlen($model->gambar) > 1) and file_exists(Url::to("@webroot/uploaded/berita/".$model->gambar))) { ?>
		<?= Html::img(Url::to("@web/uploaded/berita/".$model->gambar),['class'=>'img img-responsive', 'style' => 'background-image: linear-gradient(to right, blue, #316767);padding:4px;margin:2rem;border-radius:10px']) ?>
		<?php } ?>
		<?= $model->isi ?>
	</div>
</div>