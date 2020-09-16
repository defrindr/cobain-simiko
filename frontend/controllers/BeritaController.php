<?php

namespace frontend\controllers;

use Yii;
use common\models\ModuleBerita;
use common\models\ModuleBeritaSearch;
use yii\web\Controller;


class BeritaController extends Controller
{
    /**
     * Lists all ModuleBerita models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = \common\models\ModuleBerita::find()->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}
