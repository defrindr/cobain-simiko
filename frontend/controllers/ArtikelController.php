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
		];
	}


	public function actionIndex()
	{
		// $search = ModuleBeritaSearch::find();
		// $dataProvider = $search->search(Yii::$app->request->queryParams);
		$model = ModuleBerita::find()->all();
		return $this->render('index',
			[
				'model'=>$model
		]);
	}

	public function actionView($id)
	{
		$model = ModuleBerita::findOne($id);

		return $this->render('view',['model'=>$model]);
	}

	protected function findModel($id)
	{
		if(($model = ModuleBerita::findOne($id)) !== []){
			return $model;
		} else 
		{
			throw new \yii\web\NotFoundHttpException('artikel is not found');
			
		}
	}
}