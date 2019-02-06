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
            [['deleted_at'], 'safe'],
            [['subject'], 'string', 'max' => 250],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
