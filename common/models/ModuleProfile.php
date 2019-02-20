<?php

namespace common\models;

use Yii;
use borales\extensions\phoneInput\PhoneInputValidator;  
use \common\models\base\ModuleProfile as BaseModuleProfile;

/**
 * This is the model class for table "profile".
 */
class ModuleProfile extends BaseModuleProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'nama'], 'required'],
            [['user_id'],'unique','on'=>'create'],
            [['user_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['bio'], 'string'],
            [['deleted_at','tgl_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['tempat_lahir'], 'string', 'max' => 70],
            [['no_telp'], 'string', 'max' => 20],
            ['no_telp', PhoneInputValidator::classname()],
            [['avatar'], 'string', 'max' => 255],
            [['image'],'file', 'skipOnEmpty' => true, 'extensions'=>'jpg,jpeg,gif,png', 'maxSize' => 1024*1024*2, 'on'=> ['update','create']],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
