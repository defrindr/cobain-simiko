<?php
/**
 * Defri Indra M
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;

class Check {
	public function namauser($id){
		return \common\models\ModuleProfile::find()->where(['user_id'=>$id])->one()->nama;
	}
}

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Materi' ,'url' => ['/materi']];
$this->params['breadcrumbs'][] = ['label' => $model->materi->judul ,'url' => ['/materi/detail','id'=>$model->materi->id]];
$this->params['breadcrumbs'][] = ['label' => $model->judul ,'url' => '#'];

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    /*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();
?>

<div class="soal-view-data">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success">
				<div class="box-header text-center">
					<h4>Info</h4>
				</div>
				<div class="box-body">
					<?php 
					$gridSoalView = [
						'judul',
						[
							'attribute' => 'created_by',
							'label' => 'Dibuat Oleh',
							'value' => function($model){
								return Check::namauser($model->created_by);
							}
						],
						[
							'attribute' => 'kelas',
							'label' => 'Kelas',
							'value' => function($model){
								return $model->materi->kelas->grade." ".$model->materi->kelas->jurusan->nama." ".$model->materi->kelas->kelas;
							}
						],
						[
							'attribute' => 'siswa_count',
							'label' => 'Anggota Kelas',
							'value' => function($model){
								return count($model->materi->kelas->moduleSiswas);
							}
						],
						[
							'attribute' => 'jmlJawaban',
							'label' => 'Jumlah Siswa Yang telah menambah jawaban',
							'value' => function($model){
								return count($model->moduleMateriSoalJawabans);
							}
						],
					];
					echo DetailView::widget([
						'model' => $model,
						'attributes' =>$gridSoalView
					]);
					 ?>
				</div>
			</div>
		</div>
	</div>
	<?php if($model->moduleMateriSoalJawabans > 0) {?>
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success">
				<div class="box-header">
					<h4>Daftar Jawaban</h4>
				</div>
				<div class="box-body">
					<?php
					$gridJawaban = [
						['class' => '\yii\grid\SerialColumn'],
						[
							'attribute' => 'siswa_id',
							'label' => 'Siswa',
							'value' => function($model){
								return $model->siswa->profile->nama;
							}
						],
						[
							'attribute' => 'nilai',
							'label' => 'Nilai',
							'value' => function($model){
								if($model->nilai <= 0){
									return "Nilai Kosong";
								}else{
									return $model->nilai;
								}
							}
						],
						[
							'attribute' => 'link',
							'format' => 'raw',
							'label' => 'Link Jawaban',
							'value' => function($model){
								return Html::a($model->link,Url::to(Url::base().'/uploaded/materi-soal-jawaban/'.$model->link),['target' => '_blank','pjax'=>0]);
							}
						],
						[
							'class' => '\yii\grid\ActionColumn',
							'template' => '{view-jawaban}',
							'buttons' => [
								'view-jawaban' => function($url,$model){
									return Html::button('<i class="glyphicon glyphicon-cloud"></i>',[
										'value' => Url::to(['/materi/change-nilai','id'=>$model->id]),
										'title' => 'Nilai dari '.$model->siswa->profile->nama,
										'class' => 'btn-actionColumn showModalButton'
									]);
								}
							],
						],
					];

					echo GridView::widget([
						'dataProvider' => $providerModuleMateriSoalJawaban,
						'columns' => $gridJawaban,
						'pjax' => 1,
						'responsiveWrap' => 0
					]);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
