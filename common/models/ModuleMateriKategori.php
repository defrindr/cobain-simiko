<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateriKategori as BaseModuleMateriKategori;

/**
 * This is the model class for table "module_materi_kategori".
 */
class ModuleMateriKategori extends BaseModuleMateriKategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['mata_pelajaran_id', 'nama'], 'required'],
            [['mata_pelajaran_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['nama'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
