<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_kelas".
 *
 * @property integer $id
 * @property integer $jurusan_id
 * @property integer $guru_id
 * @property string $kelas
 * @property string $grade
 * @property string $tahun
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleJadwal[] $moduleJadwals
 * @property \common\models\ModuleGuru $guru
 * @property \common\models\ModuleJurusan $jurusan
 * @property \common\models\ModuleMateri[] $moduleMateris
 * @property \common\models\ModuleSiswa[] $moduleSiswas
 */
class ModuleKelas extends \yii\db\ActiveRecord
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
            'moduleJadwals',
            'guru',
            'jurusan',
            'moduleMateris',
            'moduleSiswas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurusan_id', 'guru_id', 'kelas', 'grade', 'tahun'], 'required'],
            [['jurusan_id', 'guru_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['kelas', 'grade'], 'string', 'max' => 2],
            [['tahun'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_kelas';
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
            'id' => 'ID',
            'jurusan_id' => 'Jurusan ID',
            'guru_id' => 'Guru ID',
            'kelas' => 'Kelas',
            'grade' => 'Grade',
            'tahun' => 'Tahun',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleJadwals()
    {
        return $this->hasMany(\common\models\ModuleJadwal::className(), ['kelas_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuru()
    {
        return $this->hasOne(\common\models\ModuleGuru::className(), ['user_id' => 'guru_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusan()
    {
        return $this->hasOne(\common\models\ModuleJurusan::className(), ['id' => 'jurusan_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateris()
    {
        return $this->hasMany(\common\models\ModuleMateri::className(), ['kelas_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleSiswas()
    {
        return $this->hasMany(\common\models\ModuleSiswa::className(), ['kelas_id' => 'id']);
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
                'value' => time(),
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
     * @return \app\models\ModuleKelasQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleKelasQuery(get_called_class());
        return $query->where(['module_kelas.deleted_by' => 0]);
    }



    public static function findDeleted()
    {
        $query = new \app\models\ModuleKelasQuery(get_called_class());
        return $query->where('deleted_by != 0');
    }
}
