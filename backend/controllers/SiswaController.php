<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleSiswa;
use common\models\ModuleSiswaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiswaController implements the CRUD actions for ModuleSiswa model.
 */
class SiswaController extends Controller
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
     * Lists all ModuleSiswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('siswa.index')){
            $searchModel = new ModuleSiswaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else {
            throw new NotFoundHttpException;
        }
    }


    /**
     * Lists all ModuleSiswa models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        if(Yii::$app->user->can('siswa.index')){
            $searchModel = new ModuleSiswaSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else {
            throw new NotFoundHttpException;
        }
    }

    public function actionRestore($id){
        if(Yii::$app->user->can('siswa.data-restore')){
            $model = ModuleSiswa::findDeleted($id)->one();
            if($model->restoreWithRelated()){
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else {
                Yii::$app->session->setFlash('success','Data gagal direstore');
            } return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException;
            
        }
    }




    /**
     * Displays a single ModuleSiswa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('siswa.view')){
            $model = $this->findModel($id);
            $providerModuleSpp = new \yii\data\ArrayDataProvider([
                'allModels' => $model->moduleSpps,
            ]);
            return $this->render('view', [
                'model' => $this->findModel($id),
                'providerModuleSpp' => $providerModuleSpp,
            ]);
        } else {
            throw new NotFoundHttpException;
        }
    }

    /**
     * Creates a new ModuleSiswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('siswa.create')){
            $model = new ModuleSiswa();

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } else {
            throw new NotFoundHttpException;
            
        }
    }

    /**
     * Updates an existing ModuleSiswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('siswa.update')){

            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException;
            
        }
    }

    /**
     * Deletes an existing ModuleSiswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('siswa.delete')){
            if($this->findModel($id)->deleteWithRelated()){
                Yii::$app->session->setFlash('success','Siswa berhasil dihapus');
                return $this->redirect(['index']);
            }
            
        } else {
            throw new NotFoundHttpException;
            
        }
    }

    
    /**
     * Finds the ModuleSiswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleSiswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleSiswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleSpp
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleSpp()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleSpp');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleSpp', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
