<div class="form-group" id="add-module-spp">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'ModuleSpp',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'siswa_id' => [
            'label' => 'Module siswa',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleSiswa::find()->orderBy('user_id')->asArray()->all(), 'user_id', 'user_id'),
                'options' => ['placeholder' => 'Choose Module siswa'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'bulan' => ['type' => TabularForm::INPUT_TEXT],
        'tahun' => ['type' => TabularForm::INPUT_TEXT],
        'bukti_bayar' => ['type' => TabularForm::INPUT_TEXT],
        'spp' => ['type' => TabularForm::INPUT_TEXT],
        'tabungan_prakerin' => ['type' => TabularForm::INPUT_TEXT],
        'tabungan_study_tour' => ['type' => TabularForm::INPUT_TEXT],
        'total' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowModuleSpp(' . $key . '); return false;', 'id' => 'module-spp-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Module Spp', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowModuleSpp()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

