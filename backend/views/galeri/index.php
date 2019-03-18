<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleGaleriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
$this->title = 'Galeri';
$this->params['breadcrumbs'][] = $this->title;
yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();
?>
<div class="module-galeri-index">
    <div class="row">
        <?= $this->render('_index_galeri_kategori',[
                'dataProviderKategori' => $dataProviderKategori,
                'searchModelKategori' => $searchModelKategori
            ]) ?>
        <?= $this->render('_index_galeri',[
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel
            ]) ?>
    </div>


</div>