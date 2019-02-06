<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateriFile as BaseModuleMateriFile;

/**
 * This is the model class for table "module_materi_file".
 */
class ModuleMateriFile extends BaseModuleMateriFile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['materi_id', 'nama_file', 'link_file'], 'required'],
            [['materi_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['nama_file', 'link_file'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
