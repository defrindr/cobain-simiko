<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "profile".
 *
 * @property integer $user_id
 * @property string $nama
 * @property integer $tgl_lahir
 * @property string $tempat_lahir
 * @property string $bio
 * @property string $no_telp
 * @property string $avatar
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\User $user
 */
class ModuleProfile extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;



    private $_rt_softdelete;
    private $_rt_softrestore;
    public $image;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nama'], 'required'],
            [['user_id', 'tgl_lahir', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['bio'], 'string'],
            [['deleted_at'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['tempat_lahir'], 'string', 'max' => 70],
            [['no_telp'], 'string', 'max' => 20],
            [['avatar'], 'string', 'max' => 255],
            [['image'],'file', 'skipOnEmpty' => true, 'extensions'=>'jpg,jpeg,gif,png', 'maxSize' => 1024*1024*2],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nama' => 'Nama',
            'tgl_lahir' => 'Tgl Lahir',
            'tempat_lahir' => 'Tempat Lahir',
            'bio' => 'Bio',
            'no_telp' => 'No Telp',
            'avatar' => 'Avatar',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \app\models\ModuleProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleProfileQuery(get_called_class());
        return $query->where(['profile.deleted_by' => 0]);
    }



        /**
     * @inheritdoc
     * @return \app\models\ModuleProfileQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        $query = new \app\models\ModuleProfileQuery(get_called_class());
        return $query->where('profile.deleted_by != 0');
    }
}
