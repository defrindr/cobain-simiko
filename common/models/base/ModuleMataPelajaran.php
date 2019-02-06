<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_mata_pelajaran".
 *
 * @property integer $id
 * @property string $nama_mapel
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleGuru[] $moduleGurus
 * @property \common\models\ModuleJadwal[] $moduleJadwals
 * @property \common\models\ModuleMateriKategori[] $moduleMateriKategoris
 */
class ModuleMataPelajaran extends \yii\db\ActiveRecord
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
            'moduleGurus',
            'moduleJadwals',
            'moduleMateriKategoris'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_mapel'], 'required'],
            [['created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            [['nama_mapel'], 'string', 'max' => 45],
            [['nama_mapel'], 'unique'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_mata_pelajaran';
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
            'nama_mapel' => 'Nama Mapel',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleGurus()
    {
        return $this->hasMany(\common\models\ModuleGuru::className(), ['mata_pelajaran_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleJadwals()
    {
        return $this->hasMany(\common\models\ModuleJadwal::className(), ['kode_mapel' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateriKategoris()
    {
        return $this->hasMany(\common\models\ModuleMateriKategori::className(), ['mata_pelajaran_id' => 'id']);
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
     * @return \app\models\ModuleMataPelajaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleMataPelajaranQuery(get_called_class());
        return $query->where(['module_mata_pelajaran.deleted_by' => 0]);
    }
}
