<?php
namespace backend\models;

use yii\base\Model;


class modelFormGenerateAbsen extends Model {
	public $tahun;
	public $bulan;

	public function rules()
	{
		return [
			[['tahun','bulan'],'required', 'message' => '* {attribute} wajib diisi'],
			['tahun','string','max'=>4],
			['bulan','string' , 'max' => '10']
		];
	}

}


?>