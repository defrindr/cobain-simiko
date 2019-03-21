<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Dashboard";




switch (date('m')) {
	case '01':
		$bulan = "Januari";
		break;
	case '02':
		$bulan = "Februari";
		break;
	case '03':
		$bulan = "Maret";
		break;
	case '04':
		$bulan = "April";
		break;
	case '05':
		$bulan = "Mei";
		break;
	case '06':
		$bulan = "Juni";
		break;
	case '07':
		$bulan = "Juli";
		break;
	case '08':
		$bulan = "Agustus";
		break;
	case '09':
		$bulan = "September";
		break;
	case '10':
		$bulan = "Oktober";
		break;
	case '11':
		$bulan = "November";
		break;
	case '12':
		$bulan = "Desember";
		break;
}


$jmlKelas = \common\models\ModuleKelas::find()->all();
$jmlGuru = \common\models\ModuleGuru::find()->all();
$jmlMataPelajaran = \common\models\ModuleMataPelajaran::find()->all();
$jmlBerita = \common\models\ModuleBerita::find()->all();
$jmlBank = \common\models\ModuleBank::find()->all();
$jmlUser = \common\models\ModuleUser::find()->all();
$jmlSiswa = \common\models\ModuleSiswa::find()->all();
$jmlJadwal = \common\models\ModuleJadwal::find()->all();
$jmlSPP = \common\models\ModuleSpp::find()->where(['bulan'=>$bulan,'tahun'=>date('Y')])->all();
if(Yii::$app->user->identity->role === 20) {
	$jmlMateri = \common\models\ModuleMateri::find()->where(["created_by"=>Yii::$app->user->id])->all();
} else {
	$jmlMateri = \common\models\ModuleMateri::find()->all();
}
class test {
	public function createBox($count,$label,$link,$icon=null){
		$color = ["red","green","yellow","blue"];
		return '<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-'.$color[random_int(0, 3)].'">
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
	<div class="row">
		<?= test::createBox($jmlUser, "Pengguna",Url::to(["/user"]), "user") ?>
		<?= test::createBox($jmlSiswa , "Siswa", Url::to(['/siswa']), 'user' ) ?>
		<?= test::createBox($jmlGuru , "Guru", Url::to(['/Guru']), 'user' ) ?>
		<?= test::createBox($jmlMataPelajaran, "Mata Pelajaran", Url::to(['/mata-pelajaran']),'book') ?>
		<?= test::createBox($jmlMateri, "Materi", Url::to(["/materi"]),"bookmark") ?>
		<?= test::createBox($jmlKelas, "Kelas",Url::to(["/kelas"]),'expand') ?>
		<?= test::createBox($jmlJadwal, "Jadwal",Url::to(["/Jadwal"]),'calendar') ?>
		<?= test::createBox($jmlSPP,"SPP Bulan ini", Url::to(['/spp']),'usd') ?>
		
	</div>
</div>
