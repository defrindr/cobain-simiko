<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleMateriFile;
use common\models\ModuleMateriFileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * MateriFileController implements the CRUD actions for ModuleMateriFile model.
 */
class MateriFileController extends Controller
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
     * Lists all ModuleMateriFile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleMateriFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Displays a single ModuleMateriFile model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new ModuleMateriFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleMateriFile();

        if ($model->loadAll(Yii::$app->request->post())) {
            $materi = common\models\ModuleMateri::findOne($model->materi_id)->one();
            if($materi->created_by == Yii::$app->user->id or Yii::$app->user->can('Admin')){
                $model->file = UploadedFile::getInstance($model,"file");
                $this->checkDir();
                if($model->validate())
                {
                    $model->link_file = md5(time())."_".random_int(0,100).".".$model->file->extension;
                    $path = Url::to("@webroot/uploaded/materi-file/");
                    try {
                        if($model->saveAll()){
                            $model->file->saveAs($path.$model->link_file);
                            Yii::$app->session->setFlash('success','File Berhasil ditambahkan');
                            return $this->redirect(['index']);
                        } else {
                            Yii::$app->session->setFlash('error','File Gagal ditambahkan');
                            return $this->redirect(['index']);

                        }
                    } catch (Exception $e) {
                        Yii::$app->session->setFlash('danger','File Gagal ditambahkan');
                        return $this->redirect(['index']);
                    }
                }else {
                    Yii::$app->session->setFlash('warning','Error validasi');
                    return $this->redirect(['index']);

                }
            } else {
                Yii::$app->session->setFlash('warning','Forbidden');
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleMateriFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing ModuleMateriFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('Admin') or $model->created_by === Yii::$app->user->id){
            $file = $model->link_file;
            if($model->delete()){
                if(file_exists(Url::to("@webroot/uploaded/materi-file".$file)))
                {
                    unlink(Url::to("@webroot/uploaded/materi-file".$file));
                }
                Yii::$app->session->setFlash('success','File Berhasil dihapus');
            } else {
                Yii::$app->session->setFlash('success','File Berhasil dihapus');
            }

            return $this->redirect(['index']);

        } else {
            throw new \yii\web\ForbiddenHttpException;
        }
    }

    
    /**
     * Finds the ModuleMateriFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMateriFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleMateriFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function checkDir()
    {
        if(!file_exists(Url::to("@webroot/uploaded")))
        {
            mkdir(Url::to("@webroot/uploaded"),0777);
        }

        if(!file_exists(Url::to("@webroot/uploaded/materi-file")))
        {
            mkdir(Url::to("@webroot/uploaded/materi-file"),0777);
        }
    }
}
