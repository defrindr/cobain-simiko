<?php
/**
 *
 * Created on Sunday 21 April 2019
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * depend
 */
use common\models\ModuleMateri;
use common\models\ModuleMateriSoal;
use common\models\ModuleMateriSoalJawaban;



/**
 * NilaiController
 * Class manage Nilai materi of students
 * 
 */
class NilaiController extends Controller {

	public function actionIndex(){
		if(Yii::$app->user->identity->role == 30)
		{
			$model = new \yii\data\ArrayDataProvider([
				'allModels' => ModuleMateriSoalJawaban::find()->where(['siswa_id'=>Yii::$app->user->id])->joinWith(['materiSoal'])->asArray()->all()
			]);
			// return var_dump($model);
			return $this->render('index',['model'=>$model]);

		}else {
			throw new NotFoundHttpException;
		}
	}



}

?>