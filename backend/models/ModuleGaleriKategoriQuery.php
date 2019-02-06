<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleGaleriKategori]].
 *
 * @see \app\models\ModuleGaleriKategori
 */
class ModuleGaleriKategoriQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleGaleriKategori[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleGaleriKategori|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
