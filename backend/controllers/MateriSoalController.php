<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleMateriSoal;
use common\models\ModuleMateriSoalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * MateriSoalController implements the CRUD actions for ModuleMateriSoal model.
 */
class MateriSoalController extends Controller
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
     * Lists all ModuleMateriSoal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleMateriSoalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleMateriSoal models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleMateriSoalSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleMateriSoal::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('success','Data gagal direstore');
        } return $this->redirect(['index']);
    }




    /**
     * Displays a single ModuleMateriSoal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerModuleMateriSoalFile = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoalFiles,
        ]);
        $providerModuleMateriSoalJawaban = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoalJawabans,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleMateriSoalFile' => $providerModuleMateriSoalFile,
            'providerModuleMateriSoalJawaban' => $providerModuleMateriSoalJawaban,
        ]);
    }

    public function actionShow($id){
        $model = $this->findModel($id);
        $addJawaban = new \common\models\ModuleMateriSoalJawaban();
        $providerModuleMateriSoalFile = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoalFiles,
        ]);
        $providerModuleMateriSoalJawaban = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoalJawabans,
        ]);
        if($addJawaban->load(Yii::$app->request->post())){
            if(Yii::$app->user->identity->role == 30){
                $siswa = \common\models\ModuleSiswa::find()->where(['user_id'=>Yii::$app->user->id])->one();
                if($model->materi->kelas_id == $siswa->kelas_id){
                    $addJawaban->file = UploadedFile::getInstance($addJawaban,'file');
                    $addJawaban->link = $model->id."_".$siswa->profile->nama.".".$addJawaban->file->extension;
                    $path = Url::to('@webroot/uploaded/materi-soal-jawaban/');
                    $addJawaban->siswa_id = $siswa->user_id;
                    $addJawaban->materi_soal_id = $model->id;
                    if($addJawaban->validate()){
                        if($addJawaban->save()){
                            $this->checkDir();
                            $addJawaban->file->saveAs($path.$addJawaban->link);
                            Yii::$app->session->setFlash('success','File berhasil diupload');
                            return $this->redirect(['show','id'=>$id]);
                        }else {
                            Yii::$app->session->setFlash('error','gagal menyimpan file');
                            return $this->redirect(['show','id'=>$id]);
                        }

                    } else {
                        Yii::$app->session->setFlash('error','validasi error');
                        return $this->redirect(['show','id'=>$id]);
                    }

                } else {
                    Yii::$app->session->setFlash('error','Hayoloh bukan kelasmu ini !!');
                    return $this->redirect(['show','id'=>$id]);
                }
            }else {
                Yii::$app->session->setFlash('warning','Anda Bukan Siswa !!!');
                return $this->redirect(['show','id'=>$id]);
            }
        }
        return $this->render('_view', [
            'model' => $this->findModel($id),
            'providerModuleMateriSoalFile' => $providerModuleMateriSoalFile,
            'providerModuleMateriSoalJawaban' => $providerModuleMateriSoalJawaban,
            'addJawaban' => $addJawaban
        ]);
    }

    /**
     * Creates a new ModuleMateriSoal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleMateriSoal();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleMateriSoal model.
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
     * Deletes an existing ModuleMateriSoal model.
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
     * Finds the ModuleMateriSoal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMateriSoal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleMateriSoal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriSoalFile
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriSoalFile()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriSoalFile');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriSoalFile', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriSoalJawaban
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriSoalJawaban()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriSoalJawaban');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriSoalJawaban', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Check dir exist or not
     * if dir is not exist
     * create dir
     *
     * reference http://youtube.com
     * no return value
     */
    public function checkDir(){

        if(!file_exists(Url::to('@webroot'))) {
            mkdir(Url::to('@webroot/uploaded'),0777,true);
        }
        if(!file_exists(Url::to(Yii::$app->basePath."/web/uploaded/materi-soal-jawaban"))){
            mkdir(Url::to(Yii::$app->basePath."/web/uploaded/materi-soal-jawaban"),0777,true);
        }
    }
}
