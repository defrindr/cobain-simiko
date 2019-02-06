<?php

namespace common\models;

use Yii;
use \common\models\base\ModuleSpp as BaseModuleSpp;

/**
 * This is the model class for table "module_spp".
 */
class ModuleSpp extends BaseModuleSpp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['siswa_id', 'bank_id', 'bulan', 'tahun', 'bukti_bayar', 'status'], 'required'],
            [['siswa_id', 'bank_id', 'spp', 'tabungan_prakerin', 'tabungan_study_tour', 'total', 'created_by', 'status', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tahun', 'deleted_at'], 'safe'],
            [['bulan'], 'string', 'max' => 45],
            [['bukti_bayar'], 'string', 'max' => 250],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
