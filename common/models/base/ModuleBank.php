<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_bank".
 *
 * @property integer $id
 * @property string $no_rekening
 * @property string $nama_bank
 * @property string $atas_nama
 * @property string $gambar
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleSpp[] $moduleSpps
 */
class ModuleBank extends \yii\db\ActiveRecord
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
            'moduleSpps'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_rekening', 'nama_bank', 'atas_nama'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['no_rekening', 'atas_nama'], 'string', 'max' => 45],
            [['gambar'], 'string' , 'max' => 200],
            [['nama_bank'], 'string', 'max' => 30],
            [['image'],'file', 'skipOnEmpty' => true, 'extensions'=>'jpg,jpeg,gif,png', 'on'=>'update', 'maxSize' => 1024*1024*2],
            [['image'],'file', 'skipOnEmpty' => false, 'extensions'=>'jpg,jpeg,gif,png', 'on' => 'create', 'maxSize' => 1024*1024*2],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_bank';
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
            'no_rekening' => 'No Rekening',
            'nama_bank' => 'Nama Bank',
            'atas_nama' => 'Atas Nama',
            'gambar' => 'Gambar',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleSpps()
    {
        return $this->hasMany(\common\models\ModuleSpp::className(), ['bank_id' => 'id']);
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
     * @return \app\models\ModuleBankQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleBankQuery(get_called_class());
        return $query->where(['module_bank.deleted_by' => 0]);
    }


    /**
     * [find description]
     * @return [type] [description]
     */
    public static function findDeleted()
    {
        $query = new \app\models\ModuleBankQuery(get_called_class());
        return $query->where('deleted_by != 0');
    }
}
