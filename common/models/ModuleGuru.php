<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleGuru as BaseModuleGuru;

/**
 * This is the model class for table "module_guru".
 */
class ModuleGuru extends BaseModuleGuru
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'mata_pelajaran_id'], 'required'],
            [['user_id', 'mata_pelajaran_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['user_id'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
