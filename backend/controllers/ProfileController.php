<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleProfile;
use common\models\ModuleProfileSearch;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for ModuleProfile model.
 */
class ProfileController extends Controller
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
     * Lists all ModuleProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id =\Yii::$app->user->id;
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAll()
    {
        if(Yii::$app->user->can('Admin')){
            $searchModel = new ModuleProfileSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }


    /**
     * Lists all ModuleProfile models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleProfileSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleProfile::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('success','Data gagal direstore');
        } return $this->redirect(['index']);
    }



    /**
     * Updates an existing ModuleProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
            /**
             *
             * Load request data dan
             * Check request method (kalau tidak salah :v)
             * 
             */
            if ($model->loadAll(Yii::$app->request->post())) {
                $transaction = $model->getDb()->beginTransaction(); // set transaction
                $model->tgl_lahir = strtotime($model->tgl_lahir);

                $this->checkDir();

                /**
                 *  Check $model->validate()
                 */
                if($model->validate()){
                    /**
                     * Check $model->image
                     */
                    if(UploadedFile::getInstance($model,'image') != ""){ //jika gambar diupdate
                        $oldImage = $model->avatar;
                        $fileName = Yii::$app->user->identity->username."_".time().".".UploadedFile::getInstance($model,'image')->extension; //generate name file
                        $model->avatar = $fileName;
                        /**
                         * Jika data berhasil disave
                         */
                        if($model->saveAll()){
                            /**
                             * Check file gambar
                             * Jika file masih ada maka hapus file
                             */
                            if($oldImage != ""){
                                if(file_exists(Yii::$app->basePath."/web/uploaded/img-profil/".$oldImage)){
                                    unlink(Yii::$app->basePath."/web/uploaded/img-profil/".$oldImage);
                                }
                            }
                            UploadedFile::getInstance($model,'image')->saveAs(Yii::$app->basePath."/web/uploaded/img-profil/".$fileName); //save image
                            $transaction->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Profil berhasil diubah');
                            return $this->redirect(['index']);
                        } else { // jika saveAll() gagal maka
                            $transaction->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Profil gagal diubah');
                            return $this->redirect(['index']);
                        }


                    } else { // jika gambar tidak diupdate
                        /**
                         * check return bool value $model->saveAll()
                         */
                        if($model->saveAll()){
                            $transaction->commit(); // commit $model
                            Yii::$app->session->setFlash('success','Profil berhasil diubah');
                            return $this->redirect(['index']);
                        } else { // jika saveAll() gagal maka
                            $transaction->rollback(); //rollback $model
                            Yii::$app->session->setFlash('error','Profil gagal diubah');
                            return $this->redirect(['index']);
                        }
                    }
                } else { // jika gagal validate
                    Yii::$app->session->setFlash('Error','Error validation data');
                    return $this->redirect(['index']);
                }

            }  else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModuleProfile model.
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
     * Finds the ModuleProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function checkDir(){
        if (!file_exists(Yii::$app->basePath.'/web/uploaded/')) {
            mkdir(Yii::$app->basePath.'/web/uploaded/');
        }
        if (!file_exists(Yii::$app->basePath.'/web/uploaded/img-profil/')) {
            mkdir(Yii::$app->basePath.'/web/uploaded/img-profil/');
        }
    }




    /**
     * Displays a single ModuleProfile model.
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
     * Creates a new ModuleProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new ModuleProfile();

    //     if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
    //         return $this->redirect(['view', 'id' => $model->user_id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

}
