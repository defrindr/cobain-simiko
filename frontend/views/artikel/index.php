<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\StringHelper;


$this->title = "Artikel";
$this->params['breadcrumbs'][] = ['label' => 'Artikel', 'url' => ['/site/artikel']];

?>
<div class="site-index-artikel">
	
		<?php if($model){ ?>
				<div class="row">
			<?php foreach ($model as $Artikel) { ?>
					<div class="col-xs-12 col-sm-6 col-lg-4" style="height: 300px;">
						<div class="artikel" style="position: relative;">
							<div class="container-fluid text-wrap">
								<a href="<?= Url::to(['/artikel/'.$Artikel->id]) ?>"><b><?= Html::encode($Artikel->judul) ?></b></a>
								<br>
								<i class="glyphicon glyphicon-user"></i> <?= \common\models\ModuleProfile::findOne($Artikel->created_by)->nama; ?>
								
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-12" style="word-break:break-all">
									<?= Html::img(Url::to(['/uploaded/berita/'.$Artikel->gambar]),['class'=>'img img-thumbnail','style'=>'border-radius:100%;height:50px;width:50px']) ?>
									<?= StringHelper::truncateWords(htmlentities($Artikel->isi),14,'...',null,false); ?>
								</div>
							</div>
							<br>
							<div class="row" style="position: absolute;bottom: 5px; left: 5px;right: 5px">
								<div class="col-xs-6">
									<i class="glyphicon glyphicon-time"></i> <?= date('d-m-Y',$Artikel->created_at) ?>
								</div>
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
</div>
<? ?>