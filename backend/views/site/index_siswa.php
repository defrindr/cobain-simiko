<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
$this->title = 'Dashboard';
?>


<div class="site-index" style="padding:10px">
		<?php if($model){ ?>
				<div class="row">
			<?php foreach ($model as $materi) { ?>
					<div class="col-xs-12 col-sm-6 col-lg-4">
						<div class="box box-materi">
							<div class="container text-wrap">
								<a href="<?= Url::to(['/materi/view/'.$materi->id]) ?>"><b><?= Html::encode($materi->judul) ?></b></a>
								<br>
								<i class="glyphicon glyphicon-user"></i> <?= \common\models\ModuleProfile::findOne($materi->created_by)->nama; ?>
								
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-12">
									<?= Html::img(Url::to(['uploaded/materi/'.$materi->gambar]),['class'=>'img img-thumbnail','style'=>'border-radius:100%;height:50px;width:50px']) ?>
									<?= StringHelper::truncateWords(Html::encode($materi->isi),12,'...',null,false); ?>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xs-6">
									<i class="glyphicon glyphicon-time"></i> <?= date('d-m-Y',$materi->created_at) ?>
								</div>
							</div>
						</div>
					</div>
			<?php } ?>
				</div>
		<?php }else{ ?>
			<div class="row">
				<p>Materi Belum Ada.</p>
			</div>
		<?php } ?>
</div>

