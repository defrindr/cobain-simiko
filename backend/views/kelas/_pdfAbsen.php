<?php
use yii\helpers\Html;
$no=1;
?>
<span class="text-center">
	<b style="font-size: 24px">Jurnal Absensi <?= Html::encode($model->grade." ".$model->jurusan->nama." ".$model->kelas) ?></b>
	<br>
	<?= "Bulan ".$bulan." Tahun ".$tahun ?>
</span>
<hr>
<br>
<table>
	<tr>
		<td>Wali Kelas</td>
		<td>:</td>
		<td><?= $model->guru->profile->nama ?></td>
	</tr>
	<tr>
		<td>Tahun Angkatan</td>
		<td>:</td>
		<td><?= $model->tahun ?></td>
	</tr>
	<tr>
		<td>Jumlah Siswa</td>
		<td>:</td>
		<td><?= count($daftar_siswa) ?></td>
	</tr>
</table>
<br>
<br>
<br>
<center>
	<table class="table table-bordered bg-danger">
		<thead>
			<tr>
				<td rowspan="2" vertical-align="center">No</td>
				<td rowspan="2" vertical-align="center">Nama</td>
				<td colspan="31" align="center">
					Tanggal
				</td>
			</tr>
			<tr>
					<?php for($a=1;$a<=31;$a++){ ?>
						<td><?= $a?></td>
					<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($daftar_siswa as $siswa){?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $siswa->profile->nama ?></td>
					<?php for($a=1;$a<=31;$a++){ ?>
						<td></td>
					<?php } ?>
				</tr>

			<?php } ?>
			
		</tbody>
	</table>
	
</center>