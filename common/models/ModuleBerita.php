<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleBerita as BaseModuleBerita;

/**
 * This is the model class for table "module_berita".
 */
class ModuleBerita extends BaseModuleBerita
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['berita_kategori_id', 'judul', 'isi'], 'required'],
            [['berita_kategori_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['isi'], 'string'],
            [['deleted_at'], 'safe'],
            [['judul'], 'string', 'max' => 65],
            [['gambar'], 'string', 'max' => 150],
            [['image'] , 'file' , 'skipOnEmpty' => true, 'extensions' => 'jpg,png,gif,jpeg', 'maxSize' => 1024*1024*2, 'on' => ['create','update','deleteImage']],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    /**
     * 
     * @overide
     * replace ```index.php?modelName[id]=1``` to ```index.php?modelName[id]=1```
     * 
     */
    public function formName()
    {
        return '';
    }
	
}
