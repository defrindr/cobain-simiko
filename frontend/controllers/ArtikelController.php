<?php
namespace frontend\controllers;


use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\ModuleBerita;
use common\models\ModuleBeritaSearch;



/**
 * Artikel Controller
 *
 */
class ArtikelController extends Controller
{
	
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::classname(),
				'actions' => [
					'comments' => 'post'
				]
			]
		]
	}


	public function actionIndex()
	{
		$search = ModuleBeritaSearch::find();
		$dataProvider = $search->search(Yii::$app->request->queryParams);

		return $this->render([
			'index',[
				'search' => $search,
				'dataProvider' => $dataProvider
			]
		]);
	}
}