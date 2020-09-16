<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleJurusan;
use common\models\ModuleJurusanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * JurusanController implements the CRUD actions for ModuleJurusan model.
 */
class JurusanController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'restore' => ['post']
                ],
            ],
        ];
    }

    /**
     * Lists all ModuleJurusan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleJurusanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleJurusan models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleJurusanSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('data-restore', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Restore data
     */
    public function actionRestore($id)
    {
        if(Yii::$app->user->can('Admin'))
        {
            $model = ModuleJurusan::findDeleted()->where('id='.$id)->one();
            if($model->restoreWithRelated())
            {
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else 
            {
                Yii::$app->session->setFlash('error','Data gagal direstore');
            }
            return $this->redirect(['index']);
        }
    }



    /**
     * Displays a single ModuleJurusan model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     $providerModuleKelas = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->moduleKelas,
    //     ]);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'providerModuleKelas' => $providerModuleKelas,
    //     ]);
    // }

    /**
     * Creates a new ModuleJurusan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('jurusan.create'))
        {
            $model = new ModuleJurusan();

            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->saveAll())
                {
                    Yii::$app->session->setFlash('success','Data berhasil disimpan');
                } else 
                {
                    Yii::$app->session->setFlash('success','Data gagal disimpan');
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else 
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing ModuleJurusan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('jurusan.update'))
        {
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post())) {
                if($model->saveAll())
                {
                    Yii::$app->session->setFlash('success','Data berhasil disimpan');
                } else 
                {
                    Yii::$app->session->setFlash('success','Data gagal disimpan');
                }
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }
        } else 
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing ModuleJurusan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('jurusan.delete'))
        {
            if($this->findModel($id)->deleteWithRelated())
            {
                Yii::$app->session->setFlash('success','Data berhasil dihapus');
            } else 
            {
                Yii::$app->session->setFlash('success','Data gagal dihapus');
            }
        } else 
        {
            throw new ForbiddenHttpException;
            
        }

        return $this->redirect(['index']);
    }

    public function actionDpermanent($id) 
    {
        if(Yii::$app->user->can('jurusan.restore')){
            $model = $this->findModel($id);
            if($model->delete()){
                Yii::$app->session->setFlash('success','Data berhasil di hapus permanen');
            } else {
                Yii::$app->session->setFlash('error','Data gagal di hapus permanen');
            }
            return $this->redirect(['index']);
        }else {
            throw new ForbiddenHttpException;
            
        }
    }

    
    /**
     * Finds the ModuleJurusan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleJurusan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleJurusan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleKelas
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleKelas()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleKelas');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleKelas', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
