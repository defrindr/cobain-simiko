<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = "Jadwal";
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->identity->role == 30) {
    $kelas = \common\models\ModuleSiswa::findOne(yii::$app->user->id)->kelas;
}
$no = 1;
// var_dump($model);
?>

<div class="module-jadwal-pdf">
    <?php if(count($model) > 0){ ?>
        <h1><?php if(Yii::$app->user->identity->role == 30){ echo "Jadwal ".$kelas->grade." ".$kelas->jurusan->nama." ".$kelas->kelas; }  ?></h1>
        <!-- <div class="box box-success">
            <div class="box-body"> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Guru</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-success">
                        <?php foreach ($model as $each){ ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $each->kodeGuru->profile->nama ?></td>
                            <td><?= $each->mapel->nama_mapel ?></td>
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