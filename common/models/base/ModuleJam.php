<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "module_jam".
 *
 * @property integer $id
 * @property integer $jam_ke
 * @property string $jam
 *
 * @property \common\models\ModuleJadwal[] $moduleJadwals
 */
class ModuleJam extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'moduleJadwals'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jam_ke', 'jam'], 'required'],
            [['jam_ke'], 'integer'],
            [['jam'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_jam';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jam_ke' => 'Jam Ke',
            'jam' => 'Jam',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleJadwals()
    {
        return $this->hasMany(\common\models\ModuleJadwal::className(), ['jam_selesai' => 'id']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\ModuleJamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ModuleJamQuery(get_called_class());
    }



        /**
     * @inheritdoc
     * @return \app\models\ModuleJamQuery the active query used by this AR class.
     */
    public static function findDeleted()
    {
        return new \app\models\ModuleJamQuery(get_called_class());
    }
}
