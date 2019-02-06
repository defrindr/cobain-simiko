<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_siswa".
 *
 * @property integer $user_id
 * @property integer $kelas_id
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $avatar
 * @property string $no_telp
 * @property string $nama_wali
 * @property string $no_telp_wali
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\User $user
 * @property \common\models\ModuleKelas $kelas
 * @property \common\models\ModuleSpp[] $moduleSpps
 */
class ModuleSiswa extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

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
            'user',
            'kelas',
            'moduleSpps'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'kelas_id'], 'required'],
            [['user_id', 'kelas_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tanggal_lahir', 'deleted_at'], 'safe'],
            [['nama', 'tempat_lahir', 'avatar', 'nama_wali'], 'string', 'max' => 45],
            [['no_telp', 'no_telp_wali'], 'string', 'max' => 15],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_siswa';
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
            'kelas_id' => 'Kelas ID',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'avatar' => 'Avatar',
            'no_telp' => 'No Telp',
            'nama_wali' => 'Nama Wali',
            'no_telp_wali' => 'No Telp Wali',
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
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(\common\models\ModuleKelas::className(), ['id' => 'kelas_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleSpps()
    {
        return $this->hasMany(\common\models\ModuleSpp::className(), ['siswa_id' => 'user_id']);
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
                'value' => new \yii\db\Expression('NOW()'),
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
     * @return \app\models\ModuleSiswaQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleSiswaQuery(get_called_class());
        return $query->where(['module_siswa.deleted_by' => 0]);
    }
}
