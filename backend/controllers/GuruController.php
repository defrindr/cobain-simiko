<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleGuru;
use common\models\ModuleGuruSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuruController implements the CRUD actions for ModuleGuru model.
 */
class GuruController extends Controller
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
     * Lists all ModuleGuru models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleGuruSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleGuru models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        if(Yii::$app->user->can('guru.data-restore')){
            $searchModel = new ModuleGuruSearch();
            $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        } else {
            throw new \yii\web\NotFoundHttpException;
        }
    }

    public function actionRestore($id){
        if(Yii::$app->user->can('guru.restore')){
            $model = ModuleGuru::findDeleted($id)->one();
            if($model->restoreWithRelated()){
                Yii::$app->session->setFlash('success','Data berhasil direstore');
            } else {
                Yii::$app->session->setFlash('success','Data gagal direstore');
            } return $this->redirect(['index']);

        } else {
            throw new \yii\web\NotFoundHttpException;
        }

    }




    /**
     * Displays a single ModuleGuru model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $providerModuleKelas = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleKelas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleKelas' => $providerModuleKelas,
        ]);
    }

    /**
     * Creates a new ModuleGuru model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('guru.create')){
            $model = new ModuleGuru();

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            throw new \yii\web\NotFoundHttpException;
        }

    }

    /**
     * Updates an existing ModuleGuru model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('guru.update')){
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            throw new \yii\web\NotFoundHttpException;
        }


    }

    /**
     * Deletes an existing ModuleGuru model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('guru.data-restore')){
            $this->findModel($id)->deleteWithRelated();

            return $this->redirect(['index']);

        } else {
            throw new \yii\web\NotFoundHttpException;
        }

    }

    
    /**
     * Finds the ModuleGuru model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleGuru the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleGuru::findOne($id)) !== null) {
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
