<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Dashboard";



$jmlKelas = \common\models\ModuleKelas::find()->all();
$jmlGuru = \common\models\ModuleGuru::find()->all();
$jmlMataPelajaran = \common\models\ModuleMataPelajaran::find()->all();
$jmlBerita = \common\models\ModuleBerita::find()->all();
$jmlBank = \common\models\ModuleBank::find()->all();
$jmlUser = \common\models\ModuleUser::find()->all();
$jmlSiswa = \common\models\ModuleSiswa::find()->all();
$jmlJadwal = \common\models\ModuleJadwal::find()->all();
$jmlMateri = \common\models\ModuleMateri::find()->all();



?>
<div class="site-module-index">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="row">
				<div class="col-xs-4">
						<i class="glyphicon glyphicon-plus icon-lg"></i>
				</div>
				<div class="col-xs-8">
					<div class="inner">
						<h3><?= count($jmlKelas) ?></h3>
						<p>Kelas</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
</div>
