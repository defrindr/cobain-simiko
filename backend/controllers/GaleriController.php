<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleGaleri;
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
     * Lists all ModuleGaleri models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleGaleriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * [actionDataRestore description]
     * @return [type] [description]
     */
    public function actionDataRestore()
    {
        if(Yii::$app->user->can('Admin')){
            $searchModel = new ModuleGaleriSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('data-restore', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else 
        {
            throw new \Yii\web\ForbiddenHttpException;
        }
    }


    /**
     * [actionRestored description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionRestore($id)
    {
        if(Yii::$app->user->can('Admin')){
            $model = ModuleGaleri::findDeleted($id)->one();
            if($model->restoreWithRelated()){
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else {
                Yii::$app->session->setFlash('error','Data gagal direstore');
            }
            return $this->redirect(['index']);
        } else 
        {
            throw new \Yii\web\ForbiddenHttpException;
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
     * Creates a new ModuleGaleri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
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
                        $path = Yii::$app->basePath."/web/uploaded/galeri/".$fileName;

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
            throw new ForbiddenHttpException;
            
        }
    }

    /**
     * Updates an existing ModuleGaleri model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
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
                            $model->images->saveAs(Yii::$app->basePath."/web/uploaded/galeri/".$fileName);
                            if(file_exists(Yii::$app->basePath."/web/uploaded/galeri/".$oldImages)){
                                unlink(Yii::$app->basePath."/web/uploaded/galeri/".$oldImages);
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
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }





        } else {
            throw new ForbiddenHttpException;
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



    public function checkDir(){
        if(!file_exists(Yii::$app->basePath."/web/uploaded/")){
            mkdir(Yii::$app->basePath."/web/uploaded/");
        }
        if(!file_exists(Yii::$app->basePath."/web/uploaded/galeri/")){
            mkdir(Yii::$app->basePath."/web/uploaded/galeri/");
        }
    }

    
    /**
     * Finds the ModuleGaleri model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleGaleri the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleGaleri::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
