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
     * Displays a single ModuleGaleri model.
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
     * Creates a new ModuleGaleri model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleGaleri();
        if(Yii::$app->user->can('Admin')){
            if ($model->loadAll(Yii::$app->request->post())) {
                $model->images = UploadedFile::getInstances($model,'images');
                $model->scenario = "create";
                if($model->validate()){
                    $this->checkDir();
                    foreach ($model->images as $image) {
                        $upload = new ModuleGaleri();
                        $fileName = md5("galeri_").random_int(0, 100).time().".".$image->extension;
                        $upload->kategori = $model->kategori;
                        $upload->judul = $model->judul;
                        $transaction = $upload->getDb()->beginTransaction();
                        $upload->scenario = $model->scenario;
                        $upload->link = $fileName;
                        $upload->tahun = $model->tahun;
                        $upload->images = $image;
                        $path = Yii::$app->basePath."/web/uploaded/galeri/".$fileName;

                        /**
                         *
                         * Check validaion
                         * 
                         */
                        if($upload->validate()){
                            if($upload->saveAll()){
                                if($upload->images->saveAs($path)){
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
                        } else { // validate error
                            yii::$app->session->setFlash('error','Validation error');
                        }
                        return $this->redirect(['index']);
                    }
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
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
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
