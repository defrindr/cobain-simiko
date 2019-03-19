<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleProfile]].
 *
 * @see \app\models\ModuleProfile
 */
class ModuleProfileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
