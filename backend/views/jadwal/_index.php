<?php
use yii\helpers\Url;
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

<!-- 		<table>
			<tr>
				<th>No</th>
				<th>Kelas</th>
				<th>Hari</th>
				<th>Jam Mulai</th>
				<th>Jam Selesai</th>
			</tr>
			<?php foreach ($model as $each){ ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $each->kelas->grade." ".$each->kelas->jurusan->nama." ".$each->kelas->kelas ?></td>
				<td><?= $each->hari ?></td>
				<td><?= $each->jam_mulai ?></td>
				<td><?= $each->jam_selesai ?></td>
			</tr>
			<?php
			$no+=1;
			 } ?>
		</table> -->
	<?php } else { ?>
		Belum Ada Jadwal Untuk Anda Saat ini.
	<?php } ?>
</div>