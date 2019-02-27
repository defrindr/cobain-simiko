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
			['username','match','pattern' => '/^[a-zA-Z-_][A-Za-z0-9-_]*$/is', 'message'=>'Username hanya support huruf , angka dan _ . Username tidak boleh diawali dengan angka dan tidak boleh ada space diusername.'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
			['username', 'string', 'min' => 4, 'max' => 255],

			['email', 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

			['password', 'required'],
			['password', 'string', 'min' => 8, 'message' => 'Password should contain at least 8 characters.'],
			// ['password', 'match', 'pattern'=>'/^[\w\s\!\@\#\$\%\&\*\(\)\+\=\{\}\:\;\"\'\\\?\/\>\.\<\,\`\~"]*$/mi', 'message' => 'Password must contain number and alphabet']
		];
	}

}

 ?>