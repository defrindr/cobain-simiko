<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleMateri as BaseModuleMateri;

/**
 * This is the model class for table "module_materi".
 */
class ModuleMateri extends BaseModuleMateri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kelas_id', 'materi_kategori_id', 'judul', 'isi'], 'required'],
            [['kelas_id', 'materi_kategori_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['isi'], 'string'],
            [['deleted_at'], 'safe'],
            [['judul', 'gambar'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}