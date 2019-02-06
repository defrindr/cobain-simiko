<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleBank as BaseModuleBank;

/**
 * This is the model class for table "module_bank".
 */
class ModuleBank extends BaseModuleBank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['no_rekening', 'nama_bank', 'atas_nama', 'gambar'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['no_rekening', 'atas_nama', 'gambar'], 'string', 'max' => 45],
            [['nama_bank'], 'string', 'max' => 30],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
