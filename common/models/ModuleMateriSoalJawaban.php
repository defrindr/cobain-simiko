<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateriSoalJawaban as BaseModuleMateriSoalJawaban;

/**
 * This is the model class for table "module_materi_soal_jawaban".
 */
class ModuleMateriSoalJawaban extends BaseModuleMateriSoalJawaban
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['materi_soal_id', 'siswa_id', 'link'], 'required'],
            [['materi_soal_id', 'siswa_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['link'], 'string', 'max' => 100],
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
