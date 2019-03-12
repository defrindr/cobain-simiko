<?php
use yii\helpers\Html;
use \common\models\ModuleJurusan;

$jurusan = ModuleJurusan::find()->all();
?>

<div class="container-fluid banner">
	<div class="row">
		<div class="col-sm-6">
			<p><h4>Jurusan</h4></p>
			<p>
				<?php 
				foreach ($jurusan as $each) {
					echo $each->nama.'<br>';
				}
				 ?>
			</p>
		</div>
		<div class="col-sm-6">
			
		</div>
	</div>
</div>