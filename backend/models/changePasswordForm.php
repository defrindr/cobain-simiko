<?php
namespace app\models;
use yii\base\Model;
use common\models\user;

/**
 * Model For Change Password
 * Created : Defri Indra M
 * 16 March 19
 * 20:00 GMT+7
 */



class changePasswordForm extends Model
{
	public $new_pass;
	public $new_pass_repeat;
	public $old_pass;
	public $captVe;

	public function rules()
	{
		return [
			[['new_pass','new_pass_repeat','old_pass','captVe'], 'required'],
			[['new_pass'],'string', 'min' => 8, 'message' => 'Password tidak boleh kurang dari 8 karakter'],
			[['new_pass_repeat'], 'compare', 'compareAttribute' => 'new_pass'],
			// ['old_pass','findPassword'],
			['captVe', 'captcha'],
		];
	}
	// public functionn findPassword($attribute,$aprams)
	// {
	// 	$user = 
	// }
	public function attributeLabels()
	{
		return [
			'new_pass' => 'New Password',
			'new_pass_repeat' => 'Repeat New Password',
			'old_pass' => 'Old Password',
			'captVe' => 'Verification Captcha'
		];
	}
}

?>