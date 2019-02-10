<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_galeri".
 *
 * @property integer $id
 * @property integer $kategori
 * @property string $link
 * @property string $judul
 * @property string $tahun
 * @property integer $uploaded_by
 * @property integer $uploaded_at
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property integer $lock
 *
 * @property \common\models\ModuleGaleriKategori $kategori0
 */
class ModuleGaleri extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;
    public $images;

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
            'kategori0'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori', 'link', 'judul', 'tahun', 'deleted_by'], 'required'],
            [['kategori', 'uploaded_by', 'uploaded_at', 'updated_by', 'updated_at', 'deleted_by', 'lock'], 'integer'],
            [['tahun', 'deleted_at'], 'safe'],
            [['link'], 'string', 'max' => 200],
            [['judul'], 'string', 'max' => 45],
            [['images'], 'file', 'skipOnEmpty' => false, 'maxFiles'=> 5, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' => 'create'],
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' =>'update'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_galeri';
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
            'kategori' => 'Kategori',
            'link' => 'Link',
            'judul' => 'Judul',
            'tahun' => 'Tahun',
            'uploaded_by' => 'Uploaded By',
            'uploaded_at' => 'Uploaded At',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori0()
    {
        return $this->hasOne(\common\models\ModuleGaleriKategori::className(), ['id' => 'kategori']);
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
     * @return \app\models\ModuleGaleriQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleGaleriQuery(get_called_class());
        return $query->where(['module_galeri.deleted_by' => 0]);
    }

    /**
     * find deleted
     * @return \app\models\ModuleGaleriQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        $query = new \app\models\ModuleGaleriQuery(get_called_class());
        return $query->where('deleted_by != 0');
    }
}
