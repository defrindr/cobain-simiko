<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleBerita;
use common\models\ModuleBeritaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\ForbiddenHttpException; // enable forbidden access
use yii\web\UploadedFile; //require to upload image
use yii\helpers\Url; // require


/**
 * BeritaController implements the CRUD actions for ModuleBerita model.
 */
class BeritaController extends Controller
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
     * Lists all ModuleBerita models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleBeritaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleBerita model.
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
     * Creates a new ModuleBerita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * Hanya user dengan role admin
         * yang dapat menambahkan berita
         * 
         * //referensi https://yiiframework.com
         */
        if(Yii::$app->user->can('berita.create')) {
            $model = new ModuleBerita();
            $model->image = UploadedFile::getInstance($model,'image'); //get image

            if ($model->loadAll(Yii::$app->request->post())) {
                $transaction = $model->getDb()->beginTransaction(); //set transaction
                $model->scenario = "create"; //set scenario

                if ($model->image != "") {
                    $fileName = md5("berita_")."_".random_int(0, 100)."_".time().".".$model->image->extension; //generate name file
                    $model->gambar = $fileName; //set value field gambar

                    $this->checkDir(); //called func checkDIr()

                    /**
                     *
                     *  check $model->validate()
                     * 
                     */
                    if($model->validate()) // check validate
                    {
                        $path = Yii::$app->basePath."/web/uploaded/berita/".$fileName;
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
     * Updates an existing ModuleBerita model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /**
         * Hanya user dengan role admin
         * yang dapat mengubah berita
         * 
         * //referensi https://yiiframework.com
         */
        if(Yii::$app->user->can('berita.update')){
            $model = $this->findModel($id);
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
                        $fileName = md5("berita_")."_".random_int(0, 100)."_".time().".".$model->image->extension; //generate name file
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
                                if(file_exists(Yii::$app->basePath."/web/uploaded/berita/".$oldImage)){
                                    unlink(Yii::$app->basePath."/web/uploaded/berita/".$oldImage);
                                }
                            }
                            $model->image->saveAs(Yii::$app->basePath."/web/uploaded/berita/".$fileName); //save image
                            $transaction->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Data berita berhasil diubah');
                            return $this->redirect(['view','id'=>$model->id]);
                        } else { // jika saveAll() gagal maka
                            $transaction->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Data berita gagal diubah');
                            return $this->render('update', [
                                'model' => $model,
                            ]);
                        }


                    } else { // jika gambar tidak diupdate
                        /**
                         * check return bool value $model->saveAll()
                         */
                        if($model->saveAll()){
                            $model->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Data berita berhasil diubah');
                            return $this->redirect(['view','id'=>$model->id]);
                        } else { // jika saveAll() gagal maka
                            $model->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Data berita gagal diubah');
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
     * Deletes an existing ModuleBerita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /**
         * Hanya user dengan role admin
         * yang dapat menghapus berita
         * 
         * //referensi https://yiiframework.com
         */
        if(Yii::$app->user->can('berita.update')){
            $model = $this->findModel($id);
            /**
             * check gambar ada atau tidak
             */
            if($model->gambar != ""){
                
                $path = Yii::$app->basePath."/web/uploaded/berita/".$model->gambar // set path

                if(file_exists($path)){
                    unlink($path);
                }

                $model->deleteWithRelated();
                Yii:$app->session->setFlash('success','Data berhasil dihapus');
                return $this->redirect(['index']);

            } else { // jika gambar tidak ada maka

                $model->deleteWithRelated();
                Yii:$app->session->setFlash('success','Data berhasil dihapus');
                return $this->redirect(['index']);
            }
        } else { // jika permission ditolak
            throw new ForbiddenHttpException;
        }
    }


    /**
     * Delete image from berita
     * @param  int $id
     * @return mixed
     */
    public function actionDeleteImage($id)
    {
        /**
         * Hanya user dengan role Admin
         * yang dapat menghapus gambar
         * selain itu maka akan
         * return throw new ForbiddenHttpException
         *
         *
         * referensi http://stackoverflow.com
         */
        if(Yii::$app->user->can( "Admin" )){
            $model = $this->findModel($id); // mencari data dan menampungnya di $model

            $model->scenario = "deleteImage"; // set scenario deleteImage
            $transaction = $model->getDb()->beginTransaction(); //set transaction
            $image = $model->gambar; //menampung nilai $model->gambar dalam $image
            $model->gambar = ""; //set $model->gambar menjadi kosong

            /**
             * check $model validate
             */
            if($model->validate()){

                /**
                 * Check apakah $model berhasil disave
                 */
                if($model->saveAll()){
                    unlink(Yii::$app->basePath."/web/uploaded/berita/".$image); //hapus gambar
                    $transaction->commit(); // commit $model
                    Yii::$app->session->setFlash('success','Gambar berhasil dihapus'); //set flash message
                    return $this->redirect(['view','id'=>$model->id]); // return
                } else {
                    $transaction->rollback(); // rollback $model
                    Yii::$app->session->setFlash('error','Gambar gagal dihapus'); //set flash message
                    return $this->redirect(['view','id'=>$model->id]); //return
                }
            } else {
                Yii::$app->session->setFlash('error','Gambar gagal dihapus'); //set flash message
                return $this->redirect(['view','id'=>$model->id]); //return
            }
        } else {
            throw new ForbiddenHttpException;
            
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
        if(!file_exists(Url::to(Yii::$app->basePath."/web/uploaded/berita"))){
            mkdir(Url::to(Yii::$app->basePath."/web/uploaded/berita"),0777,true);
        }
    }

    
    /**
     * Finds the ModuleBerita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleBerita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleBerita::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
