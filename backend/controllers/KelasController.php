<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleKelas;
use common\models\ModuleKelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KelasController implements the CRUD actions for ModuleKelas model.
 */
class KelasController extends Controller
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
     * Lists all ModuleKelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleKelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleKelas models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleKelasSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleKelas::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('success','Data gagal direstore');
        } return $this->redirect(['index']);
    }




    /**
     * Displays a single ModuleKelas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerModuleJadwal = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleJadwals,
        ]);
        $providerModuleMateri = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateris,
        ]);
        $providerModuleSiswa = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleSiswas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleJadwal' => $providerModuleJadwal,
            'providerModuleMateri' => $providerModuleMateri,
            'providerModuleSiswa' => $providerModuleSiswa,
        ]);
    }

    /**
     * Creates a new ModuleKelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleKelas();

        if ($model->loadAll(Yii::$app->request->post())) {
            $check = \common\models\ModuleKelas::find()->where('kelas="'.$model->kelas.'" and jurusan_id='.$model->jurusan_id.' and tahun='.$model->tahun.' and grade="'.$model->grade.'"')->all();
            if(count($check) < 1){
                $model->saveAll();
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                Yii::$app->session->setFlash('error','Data already exist.');
                return $this->render('create',['model'=>$model]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleKelas model.
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
     * Deletes an existing ModuleKelas model.
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
     * Finds the ModuleKelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleKelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleKelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleJadwal
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleJadwal()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleJadwal');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleJadwal', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateri
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateri()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateri');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateri', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleSiswa
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleSiswa()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleSiswa');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleSiswa', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
