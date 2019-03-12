<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleGaleri;
use common\models\ModuleGaleriKategori;
use common\models\ModuleGaleriKategoriSearch;
use common\models\ModuleGaleriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GaleriController implements the CRUD actions for ModuleGaleri model.
 */
class GaleriController extends Controller
{
    /**
     * Set behaviors
     */
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
     * Membuat fungsi action Index
     */
    public function actionIndex()
    {
        $searchModelKategori = new ModuleGaleriKategoriSearch();
        $searchModel = new ModuleGaleriSearch();
        $dataProviderKategori = $searchModelKategori->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index',[
            'searchModel' => $searchModel,
            'searchModelKategori' => $searchModelKategori,
            'dataProviderKategori' => $dataProviderKategori,
            'dataProvider' => $dataProvider,
        ]);
    }







    /**
     * membuat fungsi action data restore & data restore kategori
     */
    public function actionDataRestore()
    {
        if(Yii::$app->user->can('Admin')){
            $searchModel = new ModuleGaleriSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('data_restore', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else 
        {
            Yii::$app->session->setFlash('error','Access Denied');
            return $this->redirect(['index']);
        }
    }

    public function actionDataRestoreKategori(){
        if(Yii::$app->user->can('Admin'))
        {
            $searchModel = new ModuleGaleriKategoriSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('data_restore_kategori', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else 
        {
            Yii::$app->session->setFlash('error','Access Denied');
            return $this->redirect(['index']);
        }
    }






    /**
     * membuat action restore dan restore kategori
     */
    public function actionRestore($id)
    {
        if(Yii::$app->user->can('Admin')){
            $model = ModuleGaleri::findDeleted($id)->where('id='.$id)->one();
            $model->deleted_by = 0;
            if($model->save()){
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else {
                Yii::$app->session->setFlash('error','Data gagal direstore');
            }
            return $this->redirect(['index']);
        } else 
        {
            Yii::$app->session->setFlash('error','Access Denied');
            return $this->redirect(['index']);
        }
    }

    public function actionRestoreKategori($id){
        if(Yii::$app->user->can('Admin'))
        {
            $model = ModuleGaleriKategori::findDeleted()->where('id='.$id)->one();
            if($model->restoreWithRelated())
            {
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else 
            {
                Yii::$app->session->setFlash('error','Data gagal direstore');
            }
            return $this->redirect(['index']);
        } else 
        {
            Yii::$app->session->setFlash('error','Access Denied');
            return $this->redirect(['index']);
        }
    }















    /**
     * Displays a single ModuleGaleri model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }










    /**
     * membuat action create dan create kategori
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('galeri.create')){
            $model = new ModuleGaleri();
            $model->scenario = "create";
            if ($model->loadAll(Yii::$app->request->post())) {
                $model->images = UploadedFile::getInstances($model,'images');
                $this->checkDir();
                /**
                 *
                 * Check validaion
                 * 
                 */
                if($model->validate()){
                    foreach ($model->images as $image) {
                        $upload = new ModuleGaleri();
                        $fileName = md5("galeri_").random_int(0, 100).time().".".$image->extension;
                        $upload->kategori = $model->kategori;
                        $upload->judul = $model->judul;
                        $transaction = $upload->getDb()->beginTransaction();
                        $upload->link = $fileName;
                        $upload->tahun = $model->tahun;
                        $upload->images = $image;
                        $path = Url::to("@frontend")."/web/uploaded/galeri/".$fileName;

                        if($upload->saveAll()){
                            if($image->saveAs($path)){
                                Yii::$app->session->setFlash('success','Data berhasil disimpan');
                                $transaction->commit();
                            } else {
                                $transaction->rollback();
                                yii::$app->session->setFlash('error','Validation error');
                            }
                        } else { // if saveAll() gagal
                            $transaction->rollback();
                            yii::$app->session->setFlash('error','Validation error');
                        }
                    }

                    return $this->redirect(['index']);


                }else { //if validate error
                    yii::$app->session->setFlash('error','Validation error');
                    return $this->renderAjax('create', [
                        'model' => $model,
                        ]);
                }
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error','akses ditolak');
            return $this->redirect(['index']);
        }
    }

    public function actionCreateKategori()
    {
        if(Yii::$app->user->can('galeri-kategori.create')){
            $model = new ModuleGaleriKategori();

            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->save()){
                    Yii::$app->session->setFlash("success","Data berhasil disimpan");
                } else {
                    Yii::$app->session->setFlash("error","Data gagal disimpan");
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('create_kategori', [
                    'model' => $model,
                ]);
            }
        }
    }
















    /**
     *  membuat action update dan update kategori
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can("galeri.update")){
            $model = $this->findModel($id);
            $model->scenario = "update";
            if ($model->loadAll(Yii::$app->request->post())) {
                $transaction = $model->getDb()->beginTransaction();
                /**
                 * check validate
                 */
                if($model->validate()){
                    $this->checkDir(); //check dir
                    $model->images = UploadedFile::getInstance($model,'images');
                    if($model->images != ""){
                        $oldImages = $model->link; // get old image
                        $fileName = md5("galeri_").random_int(0, 100).time().".".$model->images->extension; // generate new name
                        $model->link = $fileName; // set model link image
                        if($model->saveAll()){
                            $transaction->commit();
                            $model->images->saveAs(Url::to("@frontend")."/web/uploaded/galeri/".$fileName);
                            if(file_exists(Url::to("@frontend")."/web/uploaded/galeri/".$oldImages)){
                                unlink(Url::to("@frontend")."/web/uploaded/galeri/".$oldImages);
                            }
                            Yii::$app->session->setFlash('success','Data berhasil diubah');
                        } else { //gagal save All
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Data gagal diubah');
                        }
                    } else { // jika gambar kosong
                        if($model->saveAll()){
                            $transaction->commit();
                            Yii::$app->session->setFlash('success','Data berhasil diubah');
                        } else { //gagal save All
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Data gagal diubah');
                        }
                    }
                    return $this->redirect(['index']);
                } else { //jika validate gagal
                    Yii::$app->session->setFlash('error','Validation error');
                    return $this->redirect(['index']);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                
            return $this->renderAjax('update',['model'=>$model]);
            }
        } else {
            Yii::$app->session->setFlash('error','akses ditolak');
            return $this->redirect(['index']);
        }
    }

    public function actionUpdateKategori($id)
    {
        if(Yii::$app->user->can('galeri-kategori.update')){
            $model = $this->findModelKategori($id);

            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->save()){
                    Yii::$app->session->setFlash("success","Kategori galeri berhasil diubah");
                } else {
                    Yii::$app->session->setFlash("error","Kategori galeri gagal diubah");
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('update_kategori', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error','akses ditolak');
            return $this->redirect(['index']);
        }
    }












    /**
     * Deletes an existing ModuleGaleri model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();
        return $this->redirect(['index']);
    }

    public function actionDeleteKategori($id)
    {
        if(Yii::$app->user->can("galeri-kategori.delete")){
           if($this->findModelKategori($id)->deleteWithRelated()){
                Yii::$app->session->setFlash("success","Data berhasil dihapus");
            } else {
                Yii::$app->session->setFlash("error","Data gagal dihapus");
            }

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }


    public function actionDpermanent($id){
        if(Yii::$app->user->can('Admin')){
            $model = ModuleGaleri::findDeleted()->where('id='.$id)->one();
            $img = $model->link;
            if($model->delete()){
                Yii::$app->session->setFlash('success','Data berhasil dihapus secara permanen');
                if(file_exists(Url::to("@frontend")."/web/uploaded/galeri/".$img)){
                    unlink(Url::to("@frontend")."/web/uploaded/galeri/".$img);
                }
            }else {
                Yii::$app->session->setFlash('error','Data gagal dihapus secara permanen');
            }
            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;

        }
    }


    public function actionDpermanentKategori($id){
        if(Yii::$app->user->can('Admin')){
            $modelKategori = ModuleGaleriKategori::findDeleted()->where('id='.$id)->one();
            $modelGaleri = ModuleGaleri::findDeleted()->where('Kategori='.$id)->all();
            foreach($modelGaleri as $model){
                print_r($model->link);
            }
            exit();
            // if($model->delete()){
            //     Yii::$app->session->setFlash('success','Data berhasil dihapus secara permanen');
            // }else {
            //     Yii::$app->session->setFlash('error','Data gagal dihapus secara permanen');
            // }
            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;

        }
    }













    /**
     * membuat action untuk mengecheck apakah directori ada atau tidak
     */
    public function checkDir(){
        if(!file_exists(Url::to("@frontend")."/web/uploaded/")){
            mkdir(Url::to("@frontend")."/web/uploaded/");
        }
        if(!file_exists(Url::to("@frontend")."/web/uploaded/galeri/")){
            mkdir(Url::to("@frontend")."/web/uploaded/galeri/");
        }
    }





    /**
     * Finds the ModuleGaleri & ModuleGaleriKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleGaleri & ModuleGaleriKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleGaleri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
    }

    protected function findModelKategori($id)
    {
        if (($model = ModuleGaleriKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan.');
        }
    }
}
