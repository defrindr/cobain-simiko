<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleSiswa]].
 *
 * @see \app\models\ModuleSiswa
 */
class ModuleSiswaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleSiswa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleSiswa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
