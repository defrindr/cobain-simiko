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
$jmlJadwal = \common\models\ModuleJadwal::find()->all();
$jmlSPP = \common\models\ModuleSpp::find()->where(['bulan'=>$bulan,'tahun'=>date('Y')])->all();
$jmlGaleri = \common\models\ModuleGaleri::find()->all();

$wali_kelas = ($checkKelas = \common\models\ModuleKelas::find()->where(['guru_id'=>\common\models\ModuleGuru::find(Yii::$app->user->id)->one()->id])->one() == [])? false : true;

if(Yii::$app->user->identity->role === 20) {
	$jmlMateri = \common\models\ModuleMateri::find()->where(["created_by"=>Yii::$app->user->id])->all();
} else {
	$jmlMateri = \common\models\ModuleMateri::find()->all();
}
if($wali_kelas){
	$jmlSiswa = \common\models\ModuleSiswa::find()->where(['kelas_id' => \common\models\ModuleKelas::find()->where(['guru_id'=>\common\models\ModuleGuru::find(Yii::$app->user->id)->one()->id])->one()->id])->all();
} else {
	$jmlSiswa = \common\models\ModuleSiswa::find()->where()->all();
}


class test {
	public function createBox($count,$label,$link,$icon=null,$size=null){
		if($size == null){
			$size = 'col-lg-3 col-xs-6';
		}
		if($icon == null ){
			$icon = "book";
		}
		$color = ["red","green","yellow","blue"];
		return '<div class="'.$size.'">
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
		<?php if(Yii::$app->user->identity->role == 10){?>
			<?= test::createBox($jmlUser, "Pengguna",Url::to(["/user-manage"]), "user") ?>
			<?= test::createBox($jmlSiswa , "Siswa", Url::to(['/siswa']), 'user' ) ?>
			<?= test::createBox($jmlGuru , "Guru", Url::to(['/Guru']), 'user' ) ?>
			<?= test::createBox($jmlMataPelajaran, "Mata Pelajaran", Url::to(['/mata-pelajaran']),'book') ?>
			<?= test::createBox($jmlMateri, "Materi", Url::to(["/materi"]),"bookmark") ?>
			<?= test::createBox($jmlKelas, "Kelas",Url::to(["/kelas"]),'expand') ?>
			<?= test::createBox($jmlJadwal, "Jadwal",Url::to(["/Jadwal"]),'calendar') ?>
			<?= test::createBox($jmlSPP,"SPP Bulan ini", Url::to(['/spp']),'usd') ?>
			<?= test::createBox($jmlGaleri, "Image Galeri",Url::to(['/galeri']),'camera','col-lg-6 col-xs-6') ?>
			<?= test::createBox($jmlBerita, "Artikel Berita",Url::to(['/galeri']),'paperclip','col-lg-6 col-xs-6') ?>
		<?php }else if(Yii::$app->user->identity->role == 20){
				if($wali_kelas){?>
					<?= test::createBox($jmlSiswa , "Siswa", '#', 'user','col-md-12 col-xs-12') ?>
				<?php } ?>
			<?= test::createBox($jmlMateri, "Materi", '#',"bookmark", 'col-lg-6') ?>
			<?= test::createBox($jmlJadwal, "Jadwal",'#','calendar', 'col-lg-6') ?>
		<?php } ?>
	</div>
</div>
