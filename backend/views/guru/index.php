<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\ModuleGuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = 'Guru';

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
<div class="module-guru-index">
    <div class="box box-success">
        <div class="box-header">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
            <p>
                <?php echo Html::a('Pencarian', '#', ['class' => 'btn btn-info search-button']) ?>
                <?php if(Yii::$app->user->can('guru.restore')){ ?>
                    <?= Html::button('Restore data',['value' => Url::to(['guru/data-restore']),'title' => 'restore data', 'class' => 'showModalButton btn btn-warning', 'style' => ['margin'=> '2px 2px 2px 0']]); ?>
                <?php } ?>
            </p>
            <div class="search-form" style="display:none">
                <?=  $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
        <div class="box-body">
            <?php
            $gridColumn = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'Nama',
                'value' => function($model){
                    return $model->profile->nama;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleUser::find()->innerJoinWith(['profile'])->where(['role'=>20])->asArray()->all(), 'id', 'profile.nama'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Nama', 'id' => 'grid-module-guru-search-user_id']
            ],
            [
                'attribute' => 'mata_pelajaran_id',
                'label' => 'Mata Pelajaran',
                'value' => function($model){
                    return $model->mataPelajaran->nama_mapel;
                 },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\ModuleMataPelajaran::find()->asArray()->all(), 'id', 'nama_mapel'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Mata pelajaran', 'id' => 'grid-module-guru-search-mata_pelajaran_id']
            ],
            ['attribute' => 'lock', 'visible' => false],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function($url,$model) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                            ['update','id'=>$model->id],
                            ['data'=>['method'=>'post']]);
                    },
                ]
            ],
            ];
            ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumn,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-module-guru']],
                'panel' => false,
                'export' => false,
            ]); ?>
            
        </div>
    </div>
</div>