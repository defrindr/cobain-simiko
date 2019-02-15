<div class="form-group" id="add-module-kelas">
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
    'formName' => 'ModuleKelas',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'jurusan_id' => [
            'label' => 'Module jurusan',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\ModuleJurusan::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
                'options' => ['placeholder' => 'Choose Module jurusan'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'kelas' => ['type' => TabularForm::INPUT_TEXT],
        'grade' => ['type' => TabularForm::INPUT_TEXT],
        'tahun' => ['type' => TabularForm::INPUT_TEXT],
        "lock" => ['type' => TabularForm::INPUT_HIDDEN, 'columnOptions' => ['hidden'=>true]],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowModuleKelas(' . $key . '); return false;', 'id' => 'module-kelas-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Module Kelas', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowModuleKelas()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

