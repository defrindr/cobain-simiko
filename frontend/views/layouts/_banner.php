<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \common\models\ModuleJurusan;

$jurusan = ModuleJurusan::find()->all();

\app\assets\fontAwesomeAsset::register($this);
// \app\assets\FontAwesomeAsset::register($this);
?>


<div class="subs-group">
	<h3 class="title">Subscribe</h3>
	<form class="sub-join">
		<input type="email" class="sub-text">
		<button class="sub-button">
			<i class="fa fa-send"></i>
		</button>
	</form>
</div>
<div class="container-fluid banner">
	<div class="col-sm-4">
		<?= Html::img(Url::base() . "/uploaded/base/ireng.png", ['class' => 'img img-responsive img-center']) ?>
	</div>
	<div class="col-sm-4 text-center">
		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<h4 class="banner-title">Jurusan</h4>
				<p>
					<?php
					foreach ($jurusan as $each) {
						echo '<li style="text-align:left"><a href="#banner">' . $each->nama . '</a></li>';
					}
					?>
				</p>
			</div>
			<div class="col-xs-12 col-sm-6">
				<h4 class="banner-title">Sosial Media</h4>
				<a href="#facebook" class="fa fa-facebook fa-xs circle"></a>
				<a href="#twitter" class="fa fa-twitter fa-xs circle"></a>
				<a href="#instagram" class="fa fa-instagram fa-xs circle"></a>
				<a href="https://github.com/pringgojs/smtj.git" class="fa fa-github-square fa-xs circle"></a>
				<a href="#youtube" class="fa fa-youtube fa-xs circle"></a>
				<a href="https://id.wikipedia.org/wiki/SMK_Negeri_1_Jenangan_Ponorogo" class="fa fa-wikipedia-w fa-xs circle"></a>
			</div>
		</div>
	</div>
	<div class="col-sm-4" style="padding: 0;">
		<h4 class="banner-title text-center">Info</h4>
		<div class="col-xs-6 col-sm-12 info-1">
			Phone: (0352) 481236<br />
			Email : smkn1jenpo@yahoo.co.id<br><br>
		</div>
		<div class="col-xs-6 col-sm-12 info-2">
			Jl. Niken Gandini No.98,<br> Setono, Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur 63492
		</div>
	</div>
</div>