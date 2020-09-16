<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;


$this->title = "Artikel";
$this->params['breadcrumbs'][] = ['label' => 'Artikel', 'url' => ['/artikel']];

?>
<div class="site-index-artikel">
	<div class="container-fluid">
		<div class="col-sm-8">
			<?php if($models){ ?>
					<div class="row">
				<?php foreach ($models as $Artikel) { ?>
						<a href="<?= Url::to(['view','id'=>$Artikel->id]) ?>">
							<div class="col-xs-12 col-sm-6 col-lg-4" style="height: 300px;">
								<div class="artikel">
									<div class="row">
										<div class="berita-creator">
											<i class="glyphicon glyphicon-user"></i> <?= \common\models\ModuleProfile::findOne($Artikel->created_by)->nama ?>
											<br>
											<i class="glyphicon glyphicon-time"></i> <?= date("d M Y",$Artikel->created_at) ?>
											<br>
											<i class="glyphicon glyphicon-tags"></i> <?= $Artikel->beritaKategori->nama ?>
										</div>
									</div>
									<div class="inner text-center">
										<?= $Artikel->judul ?>

										<?php if(($Artikel->gambar != "") and file_exists(Url::to('@webroot/uploaded/berita/'.$Artikel->gambar))){ ?>
											<?= Html::img(Url::to('@web/uploaded/berita/'.$Artikel->gambar),['class'=>'img img-responsive img-circle artikel-image','style'=>'height:70px;width:70px;margin:10px auto']) ?>

										<?php } else { ?>
											<?= Html::img(Url::to('@web/uploaded/base/no-thumbnail.jpg'),['class'=>'img img-responsive img-circle artikel-image','style'=>'height:70px;width:70px;margin:10px auto']) ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</a>
				<?php } ?>
					</div>
			<?php }else{ ?>
				<div class="row">
					<p>Artikel Belum Ada.</p>
				</div>
			<?php } ?>
			<?= LinkPager::widget(['pagination'=>$pages,'hideOnSinglePage'=>false]) ?>
		</div>
		<div class="col-sm-4">
			<div class="kategori">
				<h4 class="kategori-title">Artikel Kategori</h4>
				<?php foreach($kategories as $kategori){?>
					<li><?= Html::a($kategori->nama,Url::to(['index','kategori'=>$kategori->id])) ?></li>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>
<? ?>
