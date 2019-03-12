<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
$this->title = 'Dashboard';
// var_dump();
// var_dump(Yii::$app->user->id);
// exit();
?>


<div class="site-index" style="padding:10px">
		<?php if($model){ ?>
			<?php foreach ($model as $materi) { ?>
				<!-- <div class="row"> -->
					<div class="col-xs-6">
						<div class="box <?php $box=['box-danger','box-primary','box-success']; echo $box[random_int(0, 2)]; ?>">
							<div class="box-header">
								<a href="<?= Url::to(['/materi/view/'.$materi->id]) ?>"><b><?= Html::encode($materi->judul) ?></b></a>
							</div>
							<div class="box-body">
								<div class="col-xs-3">
									<?= Html::img(Url::to(['uploaded/materi/'.$materi->gambar]),['class'=>'img img-thumbnail','style'=>'border-radius:100%;height:50px;width:50px']) ?>
								</div>
								<div class="col-xs-9">
									<?= StringHelper::truncateWords($materi->isi,5,'...',null,false); ?>
								</div>
							</div>
						</div>
					</div>
				<!-- </div> -->
			<?php } ?>
		<?php }else{ ?>
			<div class="row">
				<p>Materi Belum Ada.</p>
			</div>
		<?php } ?>
</div>

