<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = "Galeri";
$this->params['breadcrumbs'][] = ["label"=>"Galeri","url"=>"#"];


// yii\bootstrap\Modal::begin([
// 	'headerOptions' => [
// 		'id' => 'modalHeader',
// 	],
// 	'id' => 'modal',
// 	'options' => ['style'=>''],
// 	// 'size' => 'modal-lg',
// 	'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
// ]);

// echo '<div id="modalContent">
// <center><img id="modImg" class="img img-responsive" src="" alt=""></center>
// </div>';
// yii\bootstrap\Modal::end();



?>

<div class="site-galeri">
	<div class="row">
		<?php foreach ($models as $model) {
		?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
			<div class="card showModalButton card-shadow">
				<?= Html::img(Url::base()."/uploaded/galeri/".$model->link, ['class'=>'img img-responsive img-galeri','alt' => $model->judul]) ?>
				<div class="card-caption">
					<center><?= $model->judul ?></center>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<center>
		<?= LinkPager::widget(['pagination'=>$pages,'hideOnSinglePage'=>true]) ?>
		
	</center>
</div>