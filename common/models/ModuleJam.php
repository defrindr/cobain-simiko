<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleJam as BaseModuleJam;

/**
 * This is the model class for table "module_jam".
 */
class ModuleJam extends BaseModuleJam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jam_ke', 'jam'], 'required'],
            [['jam_ke'], 'integer'],
            [['jam'], 'string', 'max' => 10]
        ]);
    }
	
}
