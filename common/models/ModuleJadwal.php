<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleJadwal as BaseModuleJadwal;

/**
 * This is the model class for table "module_jadwal".
 */
class ModuleJadwal extends BaseModuleJadwal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kelas_id', 'kode_guru', 'jam_mulai', 'jam_selesai', 'hari'], 'required'],
            [['kelas_id', 'kode_guru', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['jam_mulai', 'jam_selesai', 'hari'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => 0],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
