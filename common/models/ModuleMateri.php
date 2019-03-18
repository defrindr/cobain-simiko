<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateri as BaseModuleMateri;

/**
 * This is the model class for table "module_materi".
 */
class ModuleMateri extends BaseModuleMateri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kelas_id', 'materi_kategori_id', 'judul', 'isi'], 'required'],
            [['kelas_id', 'materi_kategori_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            ['isi', 'string'],
            ['isi', 'filter', 'filter'=>function($value){ return \yii\helpers\HtmlPurifier::process($value);}],
            [['deleted_at'], 'safe'],
            ['judul', 'string', 'max' => 45],
            ['image', 'file' , 'extensions'=>'png,gif,jpg,jpeg', 'maxSize'=>1024*1024*2,'on'=>['create','update']],
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
