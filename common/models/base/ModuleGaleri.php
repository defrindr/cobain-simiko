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
 * @property integer $lock
 *
 * @property \common\models\ModuleGaleriKategori $kategori0
 */
class ModuleGaleri extends \yii\db\ActiveRecord
{
    public $images; // var menampung images
    use \mootensai\relation\RelationTrait;


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
            [['kategori', 'link', 'judul', 'tahun'], 'required'],
            [['kategori', 'uploaded_by', 'uploaded_at', 'updated_by', 'updated_at', 'lock'], 'integer'],
            [['tahun'], 'safe'],
            [['link'], 'string', 'max' => 200],
            [['judul'], 'string', 'max' => 45],
            [['images'], 'file', 'skipOnEmpty' => false, 'maxFiles'=> 5, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' => 'create'],
            [['images'], 'file', 'skipOnEmpty' => true, 'maxFiles'=> 1, 'extensions' => 'png,jpg,jpeg,gif', 'maxSize' => 1024*1024*3, 'on' =>'update'],
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
                'createdAtAttribute' => 'uploaded_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'uploaded_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\ModuleGaleriQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ModuleGaleriQuery(get_called_class());
    }
}
