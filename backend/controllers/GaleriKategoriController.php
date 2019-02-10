<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleGaleriKategori;
use common\models\ModuleGaleriKategoriSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GaleriKategoriController implements the CRUD actions for ModuleGaleriKategori model.
 */
class GaleriKategoriController extends Controller
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
     * Lists all ModuleGaleriKategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleGaleriKategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionDataRestore(){
        if(Yii::$app->user->can('Admin'))
        {
            $searchModel = new ModuleGaleriKategoriSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else 
        {
            throw new \Yii\web\ForbiddenHttpException;
        }
    }


    public function actionRestore($id){
        if(Yii::$app->user->can('Admin'))
        {
            $model = ModuleGaleriKategori::findDeleted($id)->one();
            if($model->restoreWithRelated())
            {
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else 
            {
                Yii::$app->session->setFlash('error','Data gagal direstore');
            }
            return $this->redirect(['data-restore']);
        } else 
        {
            throw new \yii\web\ForbiddenHttpException;
        }
    }










    /**
     * Displays a single ModuleGaleriKategori model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     $providerModuleGaleri = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->moduleGaleris,
    //     ]);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'providerModuleGaleri' => $providerModuleGaleri,
    //     ]);
    // }

    /**
     * Creates a new ModuleGaleriKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
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
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing ModuleGaleriKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('galeri-kategori.update')){
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->save()){
                    Yii::$app->session->setFlash("success","Data berhasil diubah");
                } else {
                    Yii::$app->session->setFlash("error","Data gagal diubah");
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException;
        }
    }

    /**
     * Deletes an existing ModuleGaleriKategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can("galeri-kategori.delete")){
           if($this->findModel($id)->deleteWithRelated()){
                Yii::$app->session->setFlash("success","Data berhasil dihapus");
            } else {
                Yii::$app->session->setFlash("error","Data gagal dihapus");
            }

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    
    /**
     * Finds the ModuleGaleriKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleGaleriKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleGaleriKategori::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleGaleri
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    // public function actionAddModuleGaleri()
    // {
    //     if (Yii::$app->request->isAjax) {
    //         $row = Yii::$app->request->post('ModuleGaleri');
    //         if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
    //             $row[] = [];
    //         return $this->renderAjax('_formModuleGaleri', ['row' => $row]);
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }
}
