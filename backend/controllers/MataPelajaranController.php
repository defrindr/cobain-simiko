<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleMataPelajaran;
use common\models\ModuleMataPelajaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * MataPelajaranController implements the CRUD actions for ModuleMataPelajaran model.
 */
class MataPelajaranController extends Controller
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
     * Lists all ModuleMataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleMataPelajaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleMataPelajaran models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleMataPelajaranSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('data-restore', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id)
    {
        $model = ModuleMataPelajaran::findDeleted()->where('id='.$id)->one();
        if (Yii::$app->user->can('Admin')) 
        {
            if($model->restoreWithRelated()){
                Yii::$app->session->setFlash('success','Data berhasil dikembalikan');
            } else 
            {
                Yii::$app->session->setFlash('error','Data gagal dikembalikan');
            }
            return $this->redirect(['index']);
        } else {
            echo "Hey!!! Who are you ?? ";
        }
    }



    /**
     * Displays a single ModuleMataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     $providerModuleGuru = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->moduleGurus,
    //     ]);
    //     $providerModuleJadwal = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->moduleJadwals,
    //     ]);
    //     $providerModuleMateriKategori = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->moduleMateriKategoris,
    //     ]);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'providerModuleGuru' => $providerModuleGuru,
    //         'providerModuleJadwal' => $providerModuleJadwal,
    //         'providerModuleMateriKategori' => $providerModuleMateriKategori,
    //     ]);
    // }

    /**
     * Creates a new ModuleMataPelajaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleMataPelajaran();
        if(Yii::$app->user->can('mapel.create')){
            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->saveAll()){
                    Yii::$app->session->setFlash('success','Data berhasil ditambahkan');
                } else {
                    Yii::$app->session->setFlash('error','Data gagal ditambahkan');
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else {
            // throw new ForbiddenHttpException;
            echo "Anda tidak mempunyai hak akses";
        }
    }

    /**
     * Updates an existing ModuleMataPelajaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('mapel.update')){
            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->saveAll()){
                    Yii::$app->session->setFlash('success','Data berhasil ditambahkan');
                } else {
                    Yii::$app->session->setFlash('error','Data gagal ditambahkan');
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else {
            // throw new ForbiddenHttpException;
            echo "Anda tidak mempunyai hak akses";
        }

    }

    /**
     * Deletes an existing ModuleMataPelajaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('mapel.delete')) 
        {
            if ($this->findModel($id)->deleteWithRelated()) 
            {
                Yii::$app->session->setFlash('success','Data berhasil dihapus');
            } else 
            {
                Yii::$aapp->session->setFlash('error','Data gagal dihapus');
            }
            return $this->redirect(['index']);
        } else 
        {
            throw new \yii\web\ForbiddenHttpException;
        }
    }
    public function actionDPermanent($id){
        /**
         * Action to hard delete
         */
        if(Yii::$app->user->can('Admin')){
            $model = ModuleMataPelajaran::findDeleted()->where('id='.$id)->one();
            if($model->delete()){
                Yii::$app->session->setFlash('success','Data berhasil dihapus secara permanent');
            }else {
                Yii::$app->session->setFlash('error','Data gagal dihapus secara permanent');
            }
            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }







    
    /**
     * Finds the ModuleMataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleMataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleMataPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleGuru
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleGuru()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleGuru');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleGuru', ['row' => $row]);
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
    * for ModuleMateriKategori
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriKategori()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriKategori');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriKategori', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
