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
if(Yii::$app->user->identity->role === 20) {
	$jmlMateri = \common\models\ModuleMateri::find()->where(["created_by"=>Yii::$app->user->id])->all();
} else {
	$jmlMateri = \common\models\ModuleMateri::find()->all();
}
class test {
	public function createBox($count,$label,$link,$icon=null){
		echo '<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3>'.count($count).'</h3>
					<p>'.$label.'</p>
				</div>
				<div class="icon">
					<i class="glyphicon glyphicon-'.$icon.'"></i>
				</div>
				<a href="'.$link.'" class="small-box-footer"> More Info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>';
	}
}



?>
<div class="site-module-index">
	
	<?= test::createBox($jmlKelas, "Kelas",Url::to(["/kelas"])) ?>
	<?= test::createBox($jmlMateri, "Materi", Url::to(["/materi"]),"book") ?>
	<?= test::createBox($jmlUser, "Pengguna",Url::to(["/user"]), "user") ?>
	<!-- <i class="glyphicon-us"></i> -->
</div>
