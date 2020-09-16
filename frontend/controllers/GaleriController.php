<?php
namespace frontend\controllers;

use common\models\ModuleGaleri;
use common\models\ModuleGaleriKategori;
use common\models\ModuleGaleriSearch;
use common\models\ModuleGaleriKategoriSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\data\Pagination;
/**
 * 
 */
class GaleriController extends Controller
{
	/**
	 * action Index
	 * @return Array Array
	 */
	public function actionIndex($kategori=null){
		if($kategori !== null){
			$query = \common\models\ModuleGaleri::find()->where(['kategori'=>addslashes($kategori)]);
		} else {
			$query = \common\models\ModuleGaleri::find();
		}
		$kategories = ModuleGaleriKategori::find()->all();

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount'=>$countQuery->count(),'pageSize' => 16]);
		$models = $query->offset($pages->offset)->limit($pages->limit)->all();
		return $this->render('index',['models'=>$models,'pages'=>$pages,'kategories'=>$kategories]);
	}
}