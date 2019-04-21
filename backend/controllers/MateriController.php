<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleMateri;
use common\models\ModuleMateriSearch;
use common\models\ModuleMateriKomentar;
use common\models\ModuleMateriKomentarSearch;
use common\models\ModuleMateriSoal;
use common\models\ModuleMateriSoalSearch;
use common\models\ModuleMateriSoalJawaban;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * MateriController implements the CRUD actions for ModuleMateri model.
 */
class MateriController extends Controller
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
     * Lists all ModuleMateri models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleMateriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleMateri models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleMateriSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('data_restore', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleMateri::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('error','Data gagal direstore');
        } return $this->redirect(['index']);
    }


    /**
     * Check info dari materi
     */
    public function actionDetail($id){
        $model = $this->findModel($id);
        $modelSoal = ModuleMateriSoal::find()->where(['materi_id'=>$id])->all();
        $providerModuleMateriSoal = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoals
        ]);
        return $this->render('detail',[
                            'model'=>$model,
                            'modelSoal'=>$modelSoal,
                            'providerModuleMateriSoal' => $providerModuleMateriSoal
                        ]);
    }

    /**
     * Check Info Soal
     */
    public function actionSoalView($id){
        $model = ModuleMateriSoal::findOne($id);
        $providerModuleMateriSoalJawaban = new \yii\data\ArrayDataProvider(['allModels'=> $model->moduleMateriSoalJawabans]);
        return $this->render('soal-view',['model'=>$model,'providerModuleMateriSoalJawaban' => $providerModuleMateriSoalJawaban]);
    }

    /**
     * Jawaban Detail
     */
    
    public function actionChangeNilai($id){
        $model = \common\models\ModuleMateriSoalJawaban::findOne($id);
        if($model->loadAll(Yii::$app->request->post())){
            if($model->save(false)){
                Yii::$app->session->setFlash('success','Nilai Berhasil Diubah');
            }else{
                Yii::$app->session->setFlash('error','Nilai Gagal Diubah');
            }

            return $this->actionSoalView(1);
        }else {
            return $this->renderAjax('change-nilai',['model'=>$model]);

        }
    }




    /**
     * Displays a single ModuleMateri model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelKomentar = new ModuleMateriKomentar();
        $providerModuleMateriFile = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriFiles,
        ]);
        $providerModuleMateriKomentar = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriKomentars,
        ]);
        $providerModuleMateriSoal = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriSoals,
        ]);
        if($modelKomentar->loadAll(Yii::$app->request->post())){
            $modelKomentar->user_id = Yii::$app->user->id;
            $modelKomentar->materi_id = $model->id;
            if($modelKomentar->save()){
                Yii::$app->session->setFlash('success','Komentar berhasil ditambahkan');
            }else {
                Yii::$app->session->setFlash('error','Komentar gagal ditambahkan');
            }
            return $this->redirect(['view','id'=>$model->id]);
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelKomentar' => $modelKomentar,
                'providerModuleMateriFile' => $providerModuleMateriFile,
                'providerModuleMateriKomentar' => $providerModuleMateriKomentar,
                'providerModuleMateriSoal' => $providerModuleMateriSoal,
            ]);
        }
    }

    /**
     * Creates a new ModuleMateri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * Hanya user dengan role admin/guru
         * yang dapat menambahkan materi
         * 
         * //referensi https://yiiframework.com
         */
        if(Yii::$app->user->can('materi')) {
            $model = new ModuleMateri();
            $model->image = UploadedFile::getInstance($model,'image'); //get image

            if ($model->loadAll(Yii::$app->request->post())) {
                $transaction = $model->getDb()->beginTransaction(); //set transaction
                $model->scenario = "create"; //set scenario

                if ($model->image != "") {
                    $fileName = "materi"."_".random_int(0, 100).time().".".$model->image->extension; //generate name file
                    $model->gambar = $fileName; //set value field gambar

                    $this->checkDir(); //called func checkDIr()

                    /**
                     *
                     *  check $model->validate()
                     * 
                     */
                    if($model->validate()) // check validate
                    {
                        $path = Url::to("@backend/web/uploaded/materi/").$fileName;
                        if($model->save()){
                            if($model->image->saveAs($path)){
                                $transaction->commit();
                                Yii::$app->session->setFlash('success','Data berhasil disimpan');
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                $transaction->rollback();
                                Yii::$app->session->setFlash('error','Data gagal disimpan');
                                return $this->render('create',['model'=>$model]);
                            }
                        } else {
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Data gagal disimpan');
                            return $this->render('create',['model'=>$model]);
                        }
                    } else{ //if wrong validate
                        Yii::$app->session->setFlash('error','Error validate data');
                        return $this->render('create',['model'=>$model]);
                    }
                } else { // jika image kosong
                    /**
                     * 
                     * check $model->validate()
                     * return boolean value
                     * 
                     */
                    if($model->validate())
                    {
                        /**
                         *
                         * check apakah $model->saveAll() berhasil atau gagal
                         * return boolean value
                         *
                         */
                        if($model->saveAll()){
                            $transaction->commit();
                            Yii::$app->session->setFlash('success','Data berhasil disimpan');
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Error create data');
                            return $this->render('create',['model'=>$model]);
                        }
                    } else {
                        Yii::$app->session->setFlash('error','Error validate data');
                        return $this->render('create',['model'=>$model]);
                    }
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing ModuleMateri model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /**
         * Hanya user dengan role admin
         * yang dapat mengubah Materi
         * 
         * //referensi https://yiiframework.com
         */
        $model = $this->findModel($id);
        if(Yii::$app->user->can('materi') and $model->created_by == Yii::$app->user->id){
            $model->image = UploadedFile::getInstance($model,'image'); // set $model->image
            /**
             *
             * Load request data dan
             * Check request method (kalau tidak salah :v)
             * 
             */
            if ($model->loadAll(Yii::$app->request->post())) {
                
                $transaction = $model->getDb()->beginTransaction(); // set transaction
                $model->scenario = "update"; // set scenario

                $this->checkDir();

                /**
                 *  Check $model->validate()
                 */
                if($model->validate()){
                    /**
                     * Check $model->image
                     */
                    if($model->image != ""){ //jika gambar diupdate
                        $oldImage = $model->gambar;
                        $fileName = "materi_".random_int(0, 100)."_".time().".".$model->image->extension; //generate name file
                        $model->gambar = $fileName;
                        /**
                         * Jika data berhasil disave
                         */
                        if($model->saveAll()){
                            /**
                             * Check file gambar
                             * Jika file masih ada maka hapus file
                             */
                            if($oldImage != ""){
                                if(file_exists(Url::to("@backend/web/uploaded/materi/").$oldImage)){
                                    unlink(Url::to("@backend/web/uploaded/materi/").$oldImage);
                                }
                            }
                            $model->image->saveAs(Url::to("@backend/web/uploaded/materi/").$fileName); //save image
                            $transaction->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Data Materi berhasil diubah');
                            return $this->redirect(['view','id'=>$model->id]);
                        } else { // jika saveAll() gagal maka
                            $transaction->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Data Materi gagal diubah');
                            return $this->render('update', [
                                'model' => $model,
                            ]);
                        }


                    } else { // jika gambar tidak diupdate
                        /**
                         * check return bool value $model->saveAll()
                         */
                        if($model->saveAll()){
                            $transaction->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Data Materi berhasil diubah');
                            return $this->redirect(['view','id'=>$model->id]);
                        } else { // jika saveAll() gagal maka
                            $transaction->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Data Materi gagal diubah');
                            return $this->redirect(['view','id'=>$model->id]);
                        }
                    }
                } else { // jika gagal validate
                    Yii::$app->session->setFlash('Error','Error validation data');
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }

            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing ModuleMateri model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('Admin') or $model->created_by == Yii::$app->user->id){
            $model->deleteWithRelated();
            return $this->redirect(['index']);
            
        }
    }

    public function actionDeleteKomentar($id)
    {
        $model = $this->findModelKomentar($id);
        if($model->materi->created_by == Yii::$app->user->id or Yii::$app->user->can('Admin') or $model->created_by == Yii::$app->user->id)
        {
            $materiId = $model->materi->id;
            if($model->delete())
            {
                Yii::$app->session->setFlash('success','Komentar berhasil dihapus');
            }else
            {
                Yii::$app->session->setFlash('error','Gagal menghapus komentar');
            }
            return $this->redirect(['view','id'=>$materiId]);
        } else 
        {
            throw new ForbiddenHttpException;
        }
    }










    
    /**
     * Finds the ModuleMateri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMateri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleMateri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Finds the ModuleMateri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMateri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelKomentar($id)
    {
        if (($model = ModuleMateriKomentar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }











    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriFile
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriFile()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriFile');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriFile', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriKomentar
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriKomentar()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriKomentar');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriKomentar', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriSoal
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriSoal()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriSoal');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriSoal', ['row' => $row]);
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
        if(!file_exists(Url::to("@webroot/uploaded/materi"))){
            mkdir(Url::to("@webroot/web/uploaded/materi"),0777,true);
        }
    }



}
