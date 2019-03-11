<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_materi".
 *
 * @property integer $id
 * @property integer $kelas_id
 * @property integer $materi_kategori_id
 * @property string $judul
 * @property string $gambar
 * @property string $isi
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleKelas $kelas
 * @property \common\models\ModuleMateriKategori $materiKategori
 * @property \common\models\ModuleMateriFile[] $moduleMateriFiles
 * @property \common\models\ModuleMateriKomentar[] $moduleMateriKomentars
 * @property \common\models\ModuleMateriSoal[] $moduleMateriSoals
 */
class ModuleMateri extends \yii\db\ActiveRecord
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
            'kelas',
            'materiKategori',
            'moduleMateriFiles',
            'moduleMateriKomentars',
            'moduleMateriSoals'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelas_id', 'materi_kategori_id', 'judul', 'isi'], 'required'],
            [['kelas_id', 'materi_kategori_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            ['isi', 'string'],
            ['isi', 'filter', 'filter'=>function($value){ return \yii\helpers\HtmlPurifier::process($value);}],
            [['deleted_at'], 'safe'],
            [['judul'], 'string', 'max' => 45],
            ['image', 'file' , 'extensions'=>'png,gif,jpg,jpeg', 'maxSize'=>1024*1024*2],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_materi';
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
            'kelas_id' => 'Kelas ID',
            'materi_kategori_id' => 'Materi Kategori ID',
            'judul' => 'Judul',
            'gambar' => 'Gambar',
            'isi' => 'Isi',
            'lock' => 'Lock',
        ];
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
    public function getMateriKategori()
    {
        return $this->hasOne(\common\models\ModuleMateriKategori::className(), ['id' => 'materi_kategori_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateriFiles()
    {
        return $this->hasMany(\common\models\ModuleMateriFile::className(), ['materi_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateriKomentars()
    {
        return $this->hasMany(\common\models\ModuleMateriKomentar::className(), ['materi_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleMateriSoals()
    {
        return $this->hasMany(\common\models\ModuleMateriSoal::className(), ['materi_id' => 'id']);
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
     * @return \app\models\ModuleMateriQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleMateriQuery(get_called_class());
        return $query->where(['module_materi.deleted_by' => 0]);
    }
    public static function findDeleted()
    {
        $query = new \app\models\ModuleMateriQuery(get_called_class());
        return $query->where('module_materi.deleted_by!=0');
    }
}
