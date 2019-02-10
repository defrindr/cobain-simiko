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
            [['kategori', 'link', 'judul', 'tahun', 'deleted_by'], 'required'],
            [['kategori', 'uploaded_by', 'uploaded_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tahun', 'deleted_at'], 'safe'],
            [['link'], 'string', 'max' => 200],
            [['judul'], 'string', 'max' => 45],
            [['images'], 'file', 'skipOnEmpty' => false, 'maxFiles'=> 5, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' => 'create'],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' =>'update'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
