<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
class Check {
	public function namauser($id){
		return \common\models\ModuleProfile::find()->where(['user_id'=>$id])->one()->nama;
	}
}


$this->title =  "Detail ".$model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Materi', 'url' => ['/materi']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '#'];

?>
<div class="materi-detail-view">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success">
				<div class="box-header text-center">
					<h4>Info</h4>
				</div>
				<div class="box-body">
					<?php
					 $gridColumnMateri = [
						['attribute' => 'id', 'visible' => false],
						[
							'attribute' => 'kelas_id',
							'label' => 'kelas',
							'value' => function($model){
								return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
							}
						],
						[
							'attribute' => 'created_by',
							'label' => 'Dibuat Oleh',
							'value' => function($model) {
								return Check::namauser($model->created_by);
							}
						],
						[
							'attribute' => 'created_at',
							'label' => 'Dibuat Pada',
							'value' => function($model) {
								return date('H:i:s / d F Y',$model->created_at);
							}
						],
						[
							'attribute' => 'updated_by',
							'label' => 'Diupdate Terakhir Oleh',
							'value' => function($model) {
								return Check::namauser($model->updated_by);
							}
						],
						[
							'attribute' => 'update_at',
							'label' => 'Update Terakhir',
							'value' => function($model) {
								return date('H:i:s / d F Y',$model->updated_at);
							}
						]
					 ];
					 echo DetailView::widget([
						 'model' => $model,
						 'attributes' => $gridColumnMateri,
					 ]);
					 ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
	if($providerModuleMateriSoal->totalCount != 0){?>
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success">
				<div class="box-header">
					<h4>Daftar Soal </h4>
					<a class="btn btn-success">Tambah Soal</a>
				</div>
				<div class="box-body">
					<?php
					 $gridSoal = [
						 ['class' => 'yii\grid\SerialColumn'],
						 'judul',
						 [
							 'attribute' => 'isi',
							 'label' => 'Soal',
						 ],
						 [
							 'attribute' => 'jmlJawaban',
							 'label' => 'jawaban diupload',
							 'value' => function($model){
								 return count($model->moduleMateriSoalJawabans);
							 }
						 ],
						 [
							 'class' => 'yii\grid\ActionColumn',
							 'template' => '{more-info}',
							 'buttons' => [
								 'more-info' => function($url,$model){
									 return Html::a('More Info',Url::to(['/materi/soal-view/','id'=>$model->id]));
								 }
							 ],
						 ],
					 ];
					 echo GridView::widget([
						 'dataProvider' => $providerModuleMateriSoal,
						 'columns' => $gridSoal,
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