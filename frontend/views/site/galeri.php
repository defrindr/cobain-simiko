<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "Galeri";
$this->params['breadcrumbs'][] = ["label"=>"Galeri","url"=>"#"];


yii\bootstrap\Modal::begin([
	'headerOptions' => [
		'id' => 'modalHeader',
	],
	'id' => 'modal',
	'size' => 'modal-lg',
	'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);

echo '<div id="modalContent">
<center><img id="modImg" class="img img-responsive" src=""></center>
</div>';
yii\bootstrap\Modal::end();

?>

<div class="site-galeri">
	<div class="row">
		<?php foreach ($models as $model) {
		?>
		<div class="col-sm-3 col-md-2 col-xs-6">
			<div class="card showModalButton" style="border: 1px solid #999;border-radius:4px;margin-bottom: 10px;padding: 4px">
				<?= Html::img(Url::base()."/uploaded/galeri/".$model->link, ['class'=>'img img-responsive','style' => 'cursor:pointer;height:200px;width:400px','alt' => $model->judul, 'onClick' => 'prevImages(this);']) ?>
				<p>
					<center><?= $model->judul ?></center>
				</p>
			</div>
		</div>
		<?php } ?>
	</div>
</div>