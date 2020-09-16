<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleMateriSoalJawaban]].
 *
 * @see \app\models\ModuleMateriSoalJawaban
 */
class ModuleMateriSoalJawabanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateriSoalJawaban[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateriSoalJawaban|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
