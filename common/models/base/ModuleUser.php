<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $role
 * @property integer $online
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\ModuleGuru $moduleGuru
 * @property \common\models\ModuleMateriKomentar[] $moduleMateriKomentars
 * @property \common\models\ModuleSiswa $moduleSiswa
 * @property \common\models\Profile $profile
 */
class ModuleUser extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'moduleGuru',
            'moduleMateriKomentars',
            'moduleSiswa',
            'profile'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'role', 'created_at', 'updated_at'], 'required'],
            [['status', 'role', 'online', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'role' => 'Role',
            'online' => 'Online',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleGuru()
    {
        return $this->hasOne(\common\models\ModuleGuru::className(), ['user_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateriKomentars()
    {
        return $this->hasMany(\common\models\ModuleMateriKomentar::className(), ['user_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleSiswa()
    {
        return $this->hasOne(\common\models\ModuleSiswa::className(), ['user_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(\common\models\ModuleProfile::className(), ['user_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\ModuleUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ModuleUserQuery(get_called_class());
    }



        /**
     * @inheritdoc
     * @return \app\models\ModuleUserQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        return new \app\models\ModuleUserQuery(get_called_class());
    }
}
