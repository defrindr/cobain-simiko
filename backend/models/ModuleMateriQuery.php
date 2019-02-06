<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleMateri]].
 *
 * @see \app\models\ModuleMateri
 */
class ModuleMateriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateri[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateri|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
