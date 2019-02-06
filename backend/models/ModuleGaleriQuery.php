<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleGaleri]].
 *
 * @see \app\models\ModuleGaleri
 */
class ModuleGaleriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleGaleri[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleGaleri|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
