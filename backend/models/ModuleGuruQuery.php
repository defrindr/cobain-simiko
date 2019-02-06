<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleGuru]].
 *
 * @see \app\models\ModuleGuru
 */
class ModuleGuruQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleGuru[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleGuru|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
