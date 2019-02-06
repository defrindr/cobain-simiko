<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleGaleriKategori as BaseModuleGaleriKategori;

/**
 * This is the model class for table "module_galeri_kategori".
 */
class ModuleGaleriKategori extends BaseModuleGaleriKategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['nama'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['nama'], 'string', 'max' => 200],
            [['nama'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
