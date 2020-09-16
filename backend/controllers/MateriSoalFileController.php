<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleMateriSoalFile;
use common\models\ModuleMateriSoalFileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;


/**
 * MateriSoalFileController implements the CRUD actions for ModuleMateriSoalFile model.
 */
class MateriSoalFileController extends Controller
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
     * Lists all ModuleMateriSoalFile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleMateriSoalFileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ModuleMateriSoalFile model.
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
     * Creates a new ModuleMateriSoalFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleMateriSoalFile();

        if ($model->loadAll(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model,'file');
            $model->gambar = time()."_".base64_encode(random_int(0, 999)).".".$model->file->extension;
            $path = Url::to("@webroot/uploaded/materi-soal-file/");
            $this->checkDir();
            if($model->validate()){
                if($model->save()){
                    $model->file->saveAs($path.$model->gambar);
                    Yii::$app->session->setFlash('success','File Berhasil disave');
                    return $this->redirect(['index']);
                }else {
                    Yii::$app->session->setFlash('error','File gagal disave');
                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('error','Validasi error');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleMateriSoalFile model.
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
     * Deletes an existing ModuleMateriSoalFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('Admin') or $model->created_by === Yii::$app->user->id){
            $file = $model->gambar;
            if($model->delete()){
                if(file_exists(Url::to("@webroot/uploaded/materi-soal-file".$file)))
                {
                    unlink(Url::to("@webroot/uploaded/materi-soal-file".$file));
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
     * Finds the ModuleMateriSoalFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMateriSoalFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleMateriSoalFile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function checkDir()
    {
        if(!file_exists(Url::to("@webroot/uploaded")))
        {
            mkdir(Url::to("@webroot/uploaded"));
        }
        if(!file_exists(Url::to("@webroot/uploaded/materi-soal-file"))){
            mkdir(Url::to("@webroot/uploaded/materi-soal-file"));
        }
    }
}
