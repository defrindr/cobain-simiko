<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\StringHelper;


$this->title = "Artikel";
$this->params['breadcrumbs'][] = ['label' => 'Artikel', 'url' => ['/site/artikel']];

?>
<div class="site-index-artikel">
	<div class="container-fluid">
		<div class="col-sm-8 col-xs-8">
			<?php if($models){ ?>
					<div class="row">
				<?php foreach ($models as $Artikel) { ?>
						<div class="col-xs-12 col-sm-6 col-lg-4" style="height: 300px;">
							<div class="artikel" style="position: relative;">
								<div class="row">
									<!-- <div class="berita-thumbnail">
										<?= Html::img(Url::to("@web/uploaded/berita/".$Artikel->gambar),['class'=>'img img-responsive img-circle']) ?>
									</div> -->
									<div class="berita-creator">
										<i class="fa fa-user"></i> <?= \common\models\ModuleProfile::findOne($Artikel->created_by)->nama ?>
										<br>
										<i class="glyphicon glyphicon-time"></i> <?= date("d M Y",$Artikel->created_at) ?>
									</div>
								</div>
								<div class="inner">
									<?= Html::a($Artikel->judul) ?>
								</div>
							</div>
						</div>
				<?php } ?>
					</div>
			<?php }else{ ?>
				<div class="row">
					<p>Artikel Belum Ada.</p>
				</div>
			<?php } ?>
			<?= LinkPager::widget(['pagination'=>$pages,'hideOnSinglePage'=>false]) ?>
		</div>
		<div class="col-sm-4 col-xs-4">
			<?php $kategori ?>
		</div>
	</div>
</div>
<? ?>