<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\ModuleMateriKomentar]].
 *
 * @see \app\models\ModuleMateriKomentar
 */
class ModuleMateriKomentarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateriKomentar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ModuleMateriKomentar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
