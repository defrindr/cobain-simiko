<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleGaleri as BaseModuleGaleri;

/**
 * This is the model class for table "module_galeri".
 */
class ModuleGaleri extends BaseModuleGaleri
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kategori', 'link', 'judul', 'tahun'], 'required'],
            [['kategori', 'uploaded_by', 'uploaded_at', 'updated_by', 'updated_at', 'lock'], 'integer'],
            [['tahun'], 'safe'],
            [['link'], 'string', 'max' => 200],
            [['judul'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
