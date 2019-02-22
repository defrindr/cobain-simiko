<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = "User Manage";


yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();


?>
<div class="module-user-manage">
	<div class="box box-danger">
		<div class="box-header">
			<?=
			Html::button('<span class="glypicon glyphicon-plus" style="font-size:18px"></span> Add User',[
				'value' => Url::to(['create']),
				'title'=>'Tambah user',
				'class' => 'btn btn-success showModalButton'
			]);
			?>
			<?=
			Html::button('<span class="glypicon glyphicon-plus" style="font-size:18px"></span> Upload User',[
				'value' => Url::to('#'),
				'class' => 'btn showModalButton btn-success'
			]);
			?>
		</div>
		<div class="box-body">
			<?php 
			$gridColumn = [
				// ['class' => 'yii\grid\SerialColumn'],
				'username',
				'email',
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
					'template' => '
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							{changeStatus}
						</div>
						<div class="col-sm-6">
							{view}
						</div>
					</div>',
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
						},
						'view' => function($url,$model){
							return Html::button('View',
								[
									'value' => Url::to(['view','id'=>$model->id]),
									'class' => 'btn btn-flat btn-primary btn-block showModalButton'
								]
							);
						}
					]
				]
			];
			 ?>
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
				'dataProvider' => $dataProvider,
				// 'filterModel' => $searchModel,
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