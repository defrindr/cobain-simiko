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
	<div class="box box-success">
		<div class="box-header">
			<?=
			Html::button('<span class="glypicon glyphicon-plus" style="font-size:18px"></span> Add siswa',[
				'value' => Url::to(['create-siswa']),
				'title'=>'Tambah user',
				'class' => 'btn btn-success showModalButton'
			]);
			?>
			<?=
			Html::button('<span class="glypicon glyphicon-plus" style="font-size:18px"></span> Add guru',[
				'value' => Url::to(['create-guru']),
				'title' => 'Tambah Guru',
				'class' => 'btn showModalButton btn-success'
			]);
			?>
		</div>
		<div class="box-body">
			<?php 
			$gridColumn = [
				// ['class' => 'yii\grid\SerialColumn'],
				[
					'attribute' => 'username',
					'format' => 'raw',
					'value' => function($model){
						return '<a href="'.Url::to(['view','id'=>$model->id]).'">'.$model->username.'</a>';
					}
				],
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
					'attribute'=>'last_login',
					'value' => function($model){
						if ((!empty($model->last_login)) and ($model->last_login !=0)) {
							return date('Y-M-d H:i:s',$model->last_login); 
						}else{ 
							return "Never";
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
									'Block',
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