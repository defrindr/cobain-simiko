<?php

$this->title = "Jadwal";
$this->params['breadcrumbs'][] = $this->title;

$no = 1;
// var_dump($model);
?>

<div class="module-jadwal-index">
	<?php if(count($model) > 0){ ?>
		<table>
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
		</table>
	<?php } else { ?>
		Belum Ada Jadwal Untuk Anda Saat ini.
	<?php } ?>
</div>