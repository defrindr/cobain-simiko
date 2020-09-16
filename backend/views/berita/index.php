<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleBeritaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;


// var_dump(Yii::$app->front)
$this->title = 'Berita';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

yii\bootstrap\Modal::begin([
'headerOptions' => ['id' => 'modalHeader'],
'id' => 'modal',
'size' => 'modal-lg',
/*'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]*/
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();

?>
<div class="module-berita-index">
    <div class="row">
        
        <?= $this->render('_index_berita_kategori',[
                'dataProviderKategori' => $dataProviderKategori, 
                'searchModelKategori' => $searchModelKategori
            ]) ?>

        <?= $this->render('_index_berita',[
                'dataProvider' => $dataProvider, 
                'searchModel' => $searchModel
            ]) ?>
    </div>
</div>
