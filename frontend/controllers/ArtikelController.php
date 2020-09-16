<?php
namespace frontend\controllers;


use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\ModuleBerita;
use common\models\ModuleBeritaSearch;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


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


	public function actionIndex($kategori=null)
	{
		// $search = ModuleBeritaSearch::find();
		// $dataProvider = $search->search(Yii::$app->request->queryParams);
		if($kategori!=null){
			$query = \common\models\ModuleBerita::find()->where(['berita_kategori_id'=>addslashes($kategori)]);
		}else {
			$query = \common\models\ModuleBerita::find();
		}
		$kategories = \common\models\ModuleBeritaKategori::find()->all();
		$countQuery = clone $query;
		$pages = new Pagination(['totalCount'=>$countQuery->count(),'pageSize' => 6]);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('index',
			[
				'models'=>$models,
				'pages' => $pages,
				'kategories' => $kategories
		]);
	}


	public function actionKategori()
	{

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