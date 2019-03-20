<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_spp".
 *
 * @property integer $id
 * @property integer $siswa_id
 * @property integer $bank_id
 * @property string $bulan
 * @property string $tahun
 * @property string $bukti_bayar
 * @property integer $spp
 * @property integer $tabungan_prakerin
 * @property integer $tabungan_study_tour
 * @property integer $total
 * @property integer $created_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleSiswa $siswa
 * @property \common\models\ModuleBank $bank
 */
class ModuleSpp extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    public $image;

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
            'siswa',
            'bank'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siswa_id', 'bank_id', 'bulan', 'tahun', 'bukti_bayar', 'status'], 'required'],
            [['siswa_id', 'bank_id', 'spp', 'tabungan_prakerin', 'tabungan_study_tour', 'total', 'created_by', 'status', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tahun', 'deleted_at'], 'safe'],
            ['image','file','extensions'=>'jpg,png,jpeg,gif','maxSize'=>1024*1024*2, 'skipOnEmpty' => false, 'on' => ['create']],
            ['image','file','extensions'=>'jpg,png,jpeg,gif','maxSize'=>1024*1024*2, 'skipOnEmpty' => true, 'on' => ['update']],
            [['bulan'], 'string', 'max' => 45],
            [['bukti_bayar'], 'string', 'max' => 250],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_spp';
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
            'siswa_id' => 'Siswa',
            'bank_id' => 'Bank',
            'bulan' => 'Bulan',
            'tahun' => 'Tahun',
            'bukti_bayar' => 'Bukti Bayar',
            'spp' => 'Spp',
            'tabungan_prakerin' => 'Tabungan Prakerin',
            'tabungan_study_tour' => 'Tabungan Study Tour',
            'total' => 'Total',
            'status' => 'Status',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(\common\models\ModuleSiswa::className(), ['user_id' => 'siswa_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(\common\models\ModuleBank::className(), ['id' => 'bank_id']);
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
     * @return \app\models\ModuleSppQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleSppQuery(get_called_class());
        return $query->where(['module_spp.deleted_by' => 0]);
    }
}
