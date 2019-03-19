<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleUser as BaseModuleUser;

/**
 * This is the model class for table "user".
 */
class ModuleUser extends BaseModuleUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['username', 'auth_key', 'password_hash', 'email', 'role', 'created_at', 'updated_at'], 'required'],
            [['status', 'role', 'created_at', 'updated_at','last_login'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
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
