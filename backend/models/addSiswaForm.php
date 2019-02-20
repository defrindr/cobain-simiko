<?php 
namespace backend\models;
use yii\base\Model;
use common\models\User;



class addSiswaForm extends Model {
	public $nama;
	public $username;
	public $email;
	public $password;

	public function rules()
	{
		return [
			['nama','required'],
			['nama', 'string'],
			['username', 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}

}

 ?>