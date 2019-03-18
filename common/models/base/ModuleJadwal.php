<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_jadwal".
 *
 * @property integer $id
 * @property integer $kelas_id
 * @property integer $kode_guru
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $hari
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleGuru $kodeGuru
 * @property \common\models\ModuleKelas $kelas
 */
class ModuleJadwal extends \yii\db\ActiveRecord
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
            'kodeGuru',
            'kelas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelas_id', 'kode_guru', 'jam_mulai', 'jam_selesai', 'hari'], 'required'],
            [['kelas_id', 'kode_guru', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['jam_mulai', 'jam_selesai', 'hari'], 'string', 'max' => 45],
            [['lock'], 'default', 'value' => 0],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_jadwal';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kelas_id' => 'Kelas Id',
            'kode_guru' => 'Kode Guru',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'hari' => 'Hari',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKodeGuru()
    {
        return $this->hasOne(\common\models\ModuleGuru::className(), ['id' => 'kode_guru']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(\common\models\ModuleKelas::className(), ['id' => 'kelas_id']);
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
     * @return \app\models\ModuleJadwalQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleJadwalQuery(get_called_class());
        return $query->where(['module_jadwal.deleted_by' => 0]);
    }



        /**
     * @inheritdoc
     * @return \app\models\ModuleJadwalQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        $query = new \app\models\ModuleJadwalQuery(get_called_class());
        return $query->where('module_jadwal.deleted_by != 0');
    }
}
