<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "module_materi_komentar".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $materi_id
 * @property string $subject
 * @property string $komentar
 * @property integer $status
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \common\models\ModuleMateri $materi
 * @property \common\models\User $user
 */
class ModuleMateriKomentar extends \yii\db\ActiveRecord
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
            'materi',
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'materi_id', 'subject', 'komentar'], 'required'],
            [['user_id', 'materi_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['komentar'], 'string'],
            [['deleted_at'], 'safe'],
            [['subject'], 'string', 'max' => 250],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_materi_komentar';
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
            'user_id' => 'User ID',
            'materi_id' => 'Materi ID',
            'subject' => 'Subject',
            'komentar' => 'Komentar',
            'status' => 'Status',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateri()
    {
        return $this->hasOne(\common\models\ModuleMateri::className(), ['id' => 'materi_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
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
     * @return \app\models\ModuleMateriKomentarQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\ModuleMateriKomentarQuery(get_called_class());
        return $query->where(['module_materi_komentar.deleted_by' => 0]);
    }
}
