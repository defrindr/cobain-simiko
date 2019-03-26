<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_materi_soal_jawaban".
 *
 * @property integer $id
 * @property integer $materi_soal_id
 * @property integer $siswa_id
 * @property string $link
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleSiswa $siswa
 * @property \common\models\ModuleMateriSoal $materiSoal
 */
class ModuleMateriSoalJawaban extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    public $file;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => Yii::$app->user->id,
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
            'materiSoal'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['materi_soal_id', 'siswa_id', 'link','file'], 'required'],
            [['materi_soal_id', 'siswa_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['deleted_at'], 'safe'],
            ['file','file','extensions'=>'pdf,xls,docx'],
            [['link'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_materi_soal_jawaban';
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
            'materi_soal_id' => 'Materi Soal ID',
            'siswa_id' => 'Siswa ID',
            'link' => 'Link',
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
    public function getMateriSoal()
    {
        return $this->hasOne(\common\models\ModuleMateriSoal::className(), ['id' => 'materi_soal_id']);
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
                'value' => Yii::$app->user->id,
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
     * @return \app\models\ModuleMateriSoalJawabanQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleMateriSoalJawabanQuery(get_called_class());
        return $query->where(['module_materi_soal_jawaban.deleted_by' => 0]);
    }



        /**
     * @inheritdoc
     * @return \app\models\ModuleMateriSoalJawabanQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        $query = new \app\models\ModuleMateriSoalJawabanQuery(get_called_class());
        return $query->where('module_materi_soal_jawaban.deleted_by != 0');
    }
}
