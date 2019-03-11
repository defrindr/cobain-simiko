<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Dashboard';
// var_dump();
// var_dump(Yii::$app->user->id);
// exit();
?>


<div class="site-index">
		<?php if($model){ ?>
				<div class="row">
			<?php foreach ($model as $materi) { ?>
					<div class="col-xs-6">
						<div class="box <?php $box=['box-danger','box-primary','box-success']; echo $box[random_int(0, 2)]; ?>">
							<div class="box-header">
								<b><?= Html::encode($materi->judul) ?></b>
							</div>
							<div class="box-body">
								<?= $materi->isi ?>
							</div>
						</div>
					</div>
			<?php } ?>
				</div>
		<?php }else{ ?>
			<div class="row">
				<?= var_dump(($model)) ?>
			</div>
		<?php } ?>
</div>

