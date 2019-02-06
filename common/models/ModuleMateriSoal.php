<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateriSoal as BaseModuleMateriSoal;

/**
 * This is the model class for table "module_materi_soal".
 */
class ModuleMateriSoal extends BaseModuleMateriSoal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['materi_id', 'judul', 'isi'], 'required'],
            [['materi_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['isi'], 'string'],
            [['deleted_at'], 'safe'],
            [['judul'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
