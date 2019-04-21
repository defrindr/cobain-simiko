<?php
use Yii\helpers\Url;
use Yii\helpers\Html;
use kartik\grid\GridView;

$this->title = "Daftar Nilai dari ".\common\models\ModuleProfile::findOne(Yii::$app->user->id)->nama;
$this->params['breadcrumbs'][] = ['label' => 'Nilai','url' => '#'];
?>
<div class="daftar-nilai-views">
		<div class="box box-success">
			<div class="box-header">
				<button class="btn btn-success">Test Button</button>
			</div>
			<div class="box-body">
				<?php
				$gridNilai = [
					['class' => '\yii\grid\SerialColumn'],
					[
						'attribute' => 'mata-pelajaran',
						'label' => 'Mata Pelajaran',
						'value' => function($model){
							return common\models\ModuleMataPelajaran::findOne(\common\models\ModuleMateriKategori::findOne(\common\models\ModuleMateri::findOne($model['materiSoal']['materi_id'])->materi_kategori_id)->mata_pelajaran_id)->nama_mapel;
						}
					],
					[
						'attribute' => 'bab',
						'label' => 'Bab',
						'value' => function($model){
							return \common\models\ModuleMateriKategori::findOne(\common\models\ModuleMateri::findOne($model['materiSoal']['materi_id'])->materi_kategori_id)->nama;
						}
					],
					[
						'attribute' => 'materiSoal.materi_id',
						'label' => 'Materi',
						'value' => function($model){
							return \common\models\ModuleMateri::findOne($model['materiSoal']['materi_id'])->judul;
						}
					],
					'materiSoal.judul',
					'nilai',
					// ['class' => '\yii\grid\ActionColumn']
				];
				echo GridView::widget([
					'dataProvider'=>$model,
					'columns' => $gridNilai
				]);
				?>
			</div>
		</div>
</div>