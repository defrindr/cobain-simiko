<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\ModuleMateriSoal */

$this->title = $model->judul;
$this->params['breadcrumbs'][] = ['label' => $model->materi->judul, 'url' => ['/materi/view','id'=>$model->materi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-materi-soal-view">
	<div class="box box-materi" style="padding: 3rem">
			<?= $model->isi ?>
			<?php if($providerModuleMateriSoalFile->totalCount > 0){
				$modelFile = \common\models\ModuleMateriSoalFile::find()->where(['materi_soal_id'=> $model->id])->all();
				?> 
				<h4>Lampiran Soal</h4>
				<?php foreach($modelFile as $file){?>
					<li><a href="<?= Url::to(['/uploaded/materi-soal-file/'.$file->gambar]) ?>"><?= $file->gambar?></a></li>
			<?php }
			 } ?>
	</div>
	<div class="box box-materi">
		<h4>Upload Jawaban</h4>
        <?php
        $check = \common\models\ModuleMateriSoalJawaban::find()->where(['materi_soal_id'=>$model->id,'created_by'=>Yii::$app->user->id])->one();
         if(($check == [])){ ?>

        <hr>
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($addJawaban,'file')->label("")->widget(FileInput::classname()); ?>
        <div class="form-group">
            <?= Html::submitButton('Upload File',['class' => 'btn btn-primary']) ?>
        </div>
        <span class="bg-red"style="padding: 5px">Note: Anda Tidak akan dapat menghapus/mengganti file setelah anda meng-uploadnya.</span>
        <?php ActiveForm::end();?>
         <?php } else {?>
            Anda Telah Menambahkan file jawaban : 
            <?= Html::a($check->link,['/uploaded/materi-soal-jawaban/'.$check->link],['target'=>'_blank']) ?>
        <?php } ?>
	</div>
























<!-- <?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'materi.id',
            'label' => 'Materi',
        ],
        'judul',
        'isi:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>ModuleMateri<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnModuleMateri = [
        ['attribute' => 'id', 'visible' => false],
        'kelas_id',
        'materi_kategori_id',
        'judul',
        'gambar',
        'isi:ntext',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->materi,
        'attributes' => $gridColumnModuleMateri    ]);
    ?>
    
    <div class="row">
<?php
if($providerModuleMateriSoalFile->totalCount){
    $gridColumnModuleMateriSoalFile = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'gambar',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriSoalFile,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal-file']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Soal File'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriSoalFile
    ]);
}
?>

    </div>
    
    <div class="row">
<?php
if($providerModuleMateriSoalJawaban->totalCount){
    $gridColumnModuleMateriSoalJawaban = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'siswa_id',
            'link',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerModuleMateriSoalJawaban,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-materi-soal-jawaban']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Module Materi Soal Jawaban'),
        ],
        'export' => false,
        'columns' => $gridColumnModuleMateriSoalJawaban
    ]);
}
?>

    </div> -->
</div>
