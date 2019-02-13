<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = "User Manage";

?>
<div class="module-user-manage">
	<div class="box box-danger">
		<div class="box-header">
			
		</div>
		<div class="box-body">
			<?php 
			$gridColumn = [
				['class' => 'yii\grid\SerialColumn'],
				'username',
				[
					'attribute' => 'role',
					'value' => function($model){
						if($model->role == 10)
						{
							return "Administrator";
						} elseif($model->role == 20)
						{
							return "Guru";
						} elseif($model->role == 30) 
						{
							return "Siswa";
						} else 
						{
							return "Undefined";
						}
					}
				],
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{changeStatus}',
					'buttons' => [
						'changeStatus' => function($url,$model){
							if($model->status == 10){
								return Html::a(
									'deactive',
									['user-manage/deactivate','id' => $model->id],
									[
										'title' => 'Deactive '.$model->username ,
										'class' => 'btn btn-danger btn-flat btn-block',
										'data' => [
											'confirm' => 'Yakin ingin menonaktifkan user ini ?',
											'method' => 'post'
										],
									]
									);
							} else {
								return Html::a(
									'active',
									['user-manage/activate','id' => $model->id],
									[
										'title' => 'Active '.$model->username ,
										'class' => 'btn btn-success btn-flat btn-block',
										'data' => [
											'confirm' => 'Yakin ingin mengaktifkan user ini ?',
											'method'=> 'post'
										],
									]
									);
							}
						}
					]
				]
			];
			 ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'dataProvider' => $dataProvider,
				'filterModel' => $searchModel,
				'columns' => $gridColumn,
				'responsiveWrap' => false,
				'pjax' => true,
				'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-bank']],
				'panel' => false,
			]);
			?>
		</div>
	</div>
</div>