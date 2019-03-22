<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = "Jadwal";
$this->params['breadcrumbs'][] = $this->title;

$no = 1;
// var_dump($model);
?>

<div class="module-jadwal-index">
	<?php if(count($model) > 0){ ?>
	<?php
	$gridColumn = [
		['class' => 'yii\grid\SerialColumn'],
		['attribute' => 'id', 'visible' => false],
		'no',
		[
			'attribute' => 'kelas_id',
			'label' => 'Kelas',
			'value' => function($model){
				return $model->kelas->grade." ".$model->kelas->jurusan->nama." ".$model->kelas->kelas;
			}
		],
		'hari',
		'jam_mulai',
		'jam_selesai',
		['attribute' => 'lock', 'visible' => false],
		[
			'class' => 'yii\grid\ActionColumns'
		],
	];
	?>
		<div class="box box-success">
			<div class="box-header">
				<?= Html::a("Download Pdf",['pdf'],['class'=>'btn btn-default']) ?>
			</div>
			<div class="box-body">
				<table class="table">
					<thead class="bg-danger">
						<th>No</th>
						<th>Guru</th>
						<th>Mapel</th>
						<th>Kelas</th>
						<th>Hari</th>
						<th>Jam</th>
					</thead>
					<tbody class="bg-success">
						<?php foreach ($model as $each){ ?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $each->kodeGuru->profile->nama ?></td>
							<td><?= $each->kodeGuru->mataPelajaran->nama_mapel ?></td>
							<td><?= $each->kelas->grade." ".$each->kelas->jurusan->nama." ".$each->kelas->kelas ?></td>
							<td><?= $each->hari ?></td>
							<td><?= $each->jam->jam ?></td>
						</tr>
						<?php
						$no+=1;
						 } ?>
						
					</tbody>
				</table>
				
			</div>
		</div>
	<?php } else { ?>
		Belum Ada Jadwal Untuk Anda Saat ini.
	<?php } ?>
</div>