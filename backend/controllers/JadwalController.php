<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleJadwal;
use common\models\ModuleJadwalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * JadwalController implements the CRUD actions for ModuleJadwal model.
 */
class JadwalController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ModuleJadwal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleJadwalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleJadwal models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleJadwalSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleJadwal::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('success','Data gagal direstore');
        } return $this->redirect(['index']);
    }




    /**
     * Displays a single ModuleJadwal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModuleJadwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleJadwal();
        if ($model->loadAll(Yii::$app->request->post())) {
            /**
             * Check apakah jadwal berbenturan atau tidak
             * return array
             */
            $data_guru = \common\models\ModuleJadwal::find()->where('kode_guru=\''.$model->kode_guru.'\' and jam_mulai=\''.$model->jam_mulai.'\' and jam_selesai=\''.$model->jam_selesai.'\' and hari=\''.$model->hari.'\'')->all();
            $data_kelas = \common\models\ModuleJadwal::find()->where('kelas_id=\''.$model->kelas_id.'\' and jam_mulai=\''.$model->jam_mulai.'\' and jam_selesai=\''.$model->jam_selesai.'\' and hari=\''.$model->hari.'\'')->all();
            if( $data_guru == [] and $data_kelas == []){
                if($model->saveAll()){
                    yii::$app->session->setFlash('success','Jadwal berhasil Disave');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    yii::$app->session->setFlash('error','Jadwal Gagal Disave');
                    return $this->redirect(['index']);
                }
            }else {
                yii::$app->session->setFlash('warning','Jadwal berbenturan');
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleJadwal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModuleJadwal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }


    /** 
     *  
     * Export ModuleJadwal information into PDF format. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionPdf($id) { 
        $model = $this->findModel($id); 

        $content = $this->renderAjax('_pdf', [ 
            'model' => $model, 
        ]); 

        $pdf = new \kartik\mpdf\Pdf([ 
            'mode' => \kartik\mpdf\Pdf::MODE_CORE, 
            'format' => \kartik\mpdf\Pdf::FORMAT_A4, 
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT, 
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER, 
            'content' => $content, 
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css', 
            'cssInline' => '.kv-heading-1{font-size:18px}', 
            'options' => ['title' => \Yii::$app->name], 
            'methods' => [ 
                'SetHeader' => [\Yii::$app->name], 
                'SetFooter' => ['{PAGENO}'], 
            ] 
        ]); 

        return $pdf->render(); 
    } 

    
    /**
     * Finds the ModuleJadwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleJadwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleJadwal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
