<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateriKomentar as BaseModuleMateriKomentar;

/**
 * This is the model class for table "module_materi_komentar".
 */
class ModuleMateriKomentar extends BaseModuleMateriKomentar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'materi_id', 'subject', 'komentar'], 'required'],
            [['user_id', 'materi_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['komentar'], 'string'],
            ['komentar', 'filter', 'filter' => function($value){ return \yii\helpers\HtmlPurifier::process($value); }],
            [['deleted_at'], 'safe'],
            [['subject'], 'string', 'max' => 250],
            ['subject', 'filter', 'filter' => function($value){ return \yii\helpers\HtmlPurifier::process($value); }],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
    /**
     * 
     * @overide
     * replace ```index.php?modelName[id]=1``` to ```index.php?modelName[id]=1```
     * 
     */
    public function formName()
    {
        return '';
    }
	
}
