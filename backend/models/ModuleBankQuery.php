<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleBank]].
 *
 * @see \app\models\ModuleBank
 */
class ModuleBankQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleBank[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleBank|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
