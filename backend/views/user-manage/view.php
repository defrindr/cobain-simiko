<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->title = "Detail User : ".$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Galeri', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 ?>
<div class="module-user-manage">
	<div class="row">
		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header">
					
				</div>
				<div class="box-body">
					<?php 
					$grid = [
						'id',
						'username',
						'role'
					];
					echo DetailView::widget([
						'model' => $model,
						'attributes' => $grid
					]);
					 ?>
				</div>
			</div>
			<!-- end box -->
		</div>
		<!-- end col -->
		<div class="col-sm-6">
			<div class="box box-success">
				<div class="box-header">
					
				</div>
				<div class="box-body">
					<?php 
					$grid = [
						'id',
						'username',
						'role'
					];
					echo DetailView::widget([
						'model' => $model,
						'attributes' => $grid
					]);
					 ?>
				</div>
			</div>
			<!-- end box -->
		</div>
	</div>
</div>