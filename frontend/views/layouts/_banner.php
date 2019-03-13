<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \common\models\ModuleJurusan;

$jurusan = ModuleJurusan::find()->all();

// \app\assets\FontAwesomeAsset::register($this);
?>

<div class="container-fluid banner">
	<div class="row">
		<div class="col-sm-4">
			<?= Html::img(Url::base()."/uploaded/base/ireng.png", ['class'=>'img img-responsive img-center']) ?> 
		</div>
		<div class="col-sm-4 text-center">
			<div class="row">
				<div class="col-xs-6">
					<h4 class="banner-title">Jurusan</h4>
					<p>
						<?php 
						foreach ($jurusan as $each) {
							echo '<li><a href="#banner">'.$each->nama.'</a></li>';
						}
						 ?>
					</p>
				</div>
				<div class="col-xs-6">
					<h4 class="banner-title">Sosial Media</h4>
						<span class="circle"><a href ="#facebook" class="fab fa-facebook fa-xs"></a></span>
						<span class="circle"><a href ="#twitter" class="fab fa-twitter fa-xs"></a></span>
						<span class="circle"><a href ="#instagram" class="fab fa-instagram fa-xs"></a></span>
						<span class="circle"><a href ="https://github.com/pringgojs/smtj.git" class="fab fa-github fa-xs"></a></span>
						<span class="circle"><a href="#youtube" class="fab fa-youtube fa-xs"></a></span>
						<span class="circle"><a href="https://id.wikipedia.org/wiki/SMK_Negeri_1_Jenangan_Ponorogo" class="fab fa-wikipedia-w fa-xs"></a></span>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<h4 class="banner-title">Info</h4>
			Phone: (0352) 481236 | <br/>
			 Email : smkn1jenpo@yahoo.co.id |<br/><br/>
			Jl. Niken Gandini No.98, Setono,<br/> Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur 63492
		</div>
	</div>
</div>