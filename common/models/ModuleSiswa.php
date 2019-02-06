<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleSiswa as BaseModuleSiswa;

/**
 * This is the model class for table "module_siswa".
 */
class ModuleSiswa extends BaseModuleSiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'kelas_id'], 'required'],
            [['user_id', 'kelas_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tanggal_lahir', 'deleted_at'], 'safe'],
            [['nama', 'tempat_lahir', 'avatar', 'nama_wali'], 'string', 'max' => 45],
            [['no_telp', 'no_telp_wali'], 'string', 'max' => 15],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
