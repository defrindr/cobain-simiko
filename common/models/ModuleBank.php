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
            [['no_rekening', 'nama_bank', 'atas_nama'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['no_rekening'], 'unique','message' => '{attribute} sudah digunakan'],
            [['no_rekening', 'atas_nama'], 'string', 'max' => 45 ,'message' => '{label} sudah pernah digunakan'],
            [['gambar'], 'string' , 'max' => 200],
            [['nama_bank'], 'string', 'max' => 30],
            [['image'],'file', 'skipOnEmpty' => true, 'extensions'=>'jpg,jpeg,gif,png', 'on'=>'update', 'maxSize' => 1024*1024*2],
            [['image'],'file', 'skipOnEmpty' => false, 'extensions'=>'jpg,jpeg,gif,png', 'on' => 'create', 'maxSize' => 1024*1024*2],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
