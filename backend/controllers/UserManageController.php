<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleUser;
use common\models\ModuleUserSearch;
use common\models\ModuleProfile;
use common\models\ModuleProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserManageController implements the CRUD actions for ModuleUser model.
 */
class UserManageController extends Controller
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
     * Lists all ModuleUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('Admin')){
            $searchModel = new ModuleUserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new NotFoundHttpException;
        }
    }

    public function actionCreate() {
        $model = new ModuleUser();
        $modelProfile = new ModuleProfile();
        if($model->loadAll(Yii::$app->request->post())){
            $model->save();
        } else {
            return $this->renderAjax('create',['model'=>$model,'modelProfile'=>$modelProfile]);
        }

    }



    public function actionActivate($id)
    {
        $model = ModuleUser::find()->where('id='.$id)->one();
        if(Yii::$app->user->can('user-manage.activate'))
        {
            if($model->status == 0)
            {
                $model->status = 10;
                if($model->save())
                {
                    Yii::$app->session->setFlash('success','User berhasil diaktifkan');
                } else 
                {
                    // save gagal
                    Yii::$app->session->setFlash('error','User gagal diaktifkan');
                }
            } else 
            {
                // jika user sudah aktif
                Yii::$app->session->setFlash('error','User sudah aktif');
            }
            return $this->redirect(['index']);
        } else 
        {
            // if permission denied
            throw new \yii\web\ForbiddenHttpException;
        }
    }

    public function actionDeactivate($id){
        $model = ModuleUser::find()->where('id='.$id)->one();
        if(Yii::$app->user->can('user-manage.deactivate'))
        {
            if(Yii::$app->user->id != $model->id){
                if($model->status == 10)
                {
                    $model->status = 0;
                    if($model->save())
                    {
                        Yii::$app->session->setFlash('success','User berhasil dinonaktifkan');
                    } else 
                    {
                        // save gagal
                        Yii::$app->session->setFlash('error','User gagal dinonaktifkan');
                    }
                } else 
                {
                    // jika user sudah aktif
                    Yii::$app->session->setFlash('error','User sudah dinonaktifkan');
                }
                return $this->redirect(['index']);
            } else 
            {
                // menonaktifkan usernya sendiri
                Yii::$app->session->setFlash('error','Tidak dapat menonaktifkan user sendiri');
                return $this->redirect(['index']);
            }
        } else 
        {
            // if permission denied
            throw new \yii\web\ForbiddenHttpException;
        }
    }

























































    /**
     * Lists all ModuleUser models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleUserSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single ModuleUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerModuleMateriKomentar = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleMateriKomentars,
        ]);
        if($model->role == 20){
            $modelProfile = ModuleGuru::find($id)->one();
        } elseif ($model->role == 30) {
            $modelProfile = ModuleSiswa::find($id)->one();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleMateriKomentar' => $providerModuleMateriKomentar,
        ]);
    }

    /**
     * Creates a new ModuleUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new ModuleUser();

    //     if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing ModuleUser model.
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModuleUser model.
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
     * Finds the ModuleUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for ModuleMateriKomentar
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddModuleMateriKomentar()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleMateriKomentar');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleMateriKomentar', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
