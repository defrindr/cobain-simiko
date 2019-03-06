<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleMateriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;


// var_dump("@frontend");

$this->title = 'Module Materi';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();

$list_kelas = [];

$modelKelas = \common\models\ModuleKelas::find()->orderBy('id')->all();
foreach ($modelKelas as $kelas) {
    $list_kelas += [$kelas->id=>$kelas->grade." ".$kelas->jurusan->nama." ".$kelas->kelas];
}

$list_bab = [];
$modelBab = \common\models\ModuleMateriKategori::find()->orderBy('id')->all();
foreach ($modelBab as $bab) {
    $list_bab += [$bab->mataPelajaran->nama_mapel=>[$bab->id => $bab->nama]];
}

?>
<div class="module-materi-index">
	<div class="row">
		<div class="col-ms-4">
			
		</div>
	</div>

</div>
