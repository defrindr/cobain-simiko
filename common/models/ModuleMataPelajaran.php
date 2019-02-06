<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMataPelajaran as BaseModuleMataPelajaran;

/**
 * This is the model class for table "module_mata_pelajaran".
 */
class ModuleMataPelajaran extends BaseModuleMataPelajaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nama_mapel'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['nama_mapel'], 'string', 'max' => 45],
            [['nama_mapel'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
