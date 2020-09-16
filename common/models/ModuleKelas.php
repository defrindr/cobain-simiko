<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleKelas as BaseModuleKelas;

/**
 * This is the model class for table "module_kelas".
 */
class ModuleKelas extends BaseModuleKelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jurusan_id', 'guru_id', 'kelas', 'grade', 'tahun'], 'required'],
            [['jurusan_id', 'guru_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            ['kelas', 'string', 'max' => 1],
            ['grade', 'string', 'max' => 3],
            // ['kelas','match','pattern'=>'/A-Z+{1}/im','message'=>'Kelas hanya boleh berisi 1 character huruf besar'],
            [['tahun'], 'string', 'max' => 45],
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
