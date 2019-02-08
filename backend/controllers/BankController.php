<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleBank;
use common\models\ModuleBankSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Reqired
 */
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;
use yii\web\UploadedFile;


/**
 * BankController implements the CRUD actions for ModuleBank model.
 */
class BankController extends Controller
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
     * Lists all ModuleBank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleBankSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleBank model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerModuleSpp = new \yii\data\ArrayDataProvider([
            'allModels' => $model->moduleSpps,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerModuleSpp' => $providerModuleSpp,
        ]);
    }

    /**
     * Creates a new ModuleBank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * 
         * Check Roled user if not 'Admin'
         * user can't running this action
         *
         */
        if(Yii::$app->user->can('Admin')){
            $model = new ModuleBank();

            if ($model->loadAll(Yii::$app->request->post())) {
                $model->image = UploadedFile::getInstance($model,'image');
                $model->scenario = "create";
                $transaction = $model->getDb()->beginTransaction();

                /**
                 *
                 *  check $model->validate()
                 * 
                 */
                if($model->validate()){
                    $fileName = md5("bank_")."_".random_int(0, 100)."_".time().".".$model->image->extension; //generate name file
                    $model->gambar = $fileName; //set value field gambar



                    $this->checkDir();
                    $path = Yii::$app->basePath."/web/uploaded/bank/".$fileName;
                    if($model->saveAll()) {
                        if($model->image->saveAs($path)){
                            $transaction->commit();
                            Yii::$app->session->setFlash('success','Data berhasil disimpan');
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else { // jika save image gagal
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Data gagal disimpan');
                            return $this->render('create',['model'=>$model]);
                        }
                    } else { //jika save gagal
                        $transaction->rollback();
                        Yii::$app->session->setFlash('error','Data gagal disimpan');
                        return $this->render('create',['model'=>$model]);
                    }

                } else { // if wrong validate
                    Yii::$app->session->setFlash('error','Validation error');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }


            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } else { // if user not 'Admin'
            throw new ForbiddenHttpException;
            
        }
    }

    /**
     * Updates an existing ModuleBank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /**
         *
         * Check Roled user if not 'Admin'
         * user can't running this action
         * 
         */
        if(Yii::$app->user->can('Admin')){
            
            $model = $this->findModel($id);

            if ($model->loadAll(Yii::$app->request->post())) {

                $model->image = UploadedFile::getInstance($model,'image');
                $model->scenario = "update";
                $transaction = $model->getDb()->beginTransaction();

                /**
                 *
                 *  check $model->validate()
                 * 
                 */
                if($model->validate()){
                    if($model->image != ""){

                        $oldImage = $model->gambar; // Menampung nama gambar lama

                        $fileName = md5("bank_")."_".random_int(0, 100)."_".time().".".$model->image->extension; //generate name file
                        $model->gambar = $fileName; //set value field gambar

                        $this->checkDir();
                        $path = Yii::$app->basePath."/web/uploaded/bank/".$fileName;
                        if($model->saveAll()) {
                            if($model->image->saveAs($path)){
                                if(file_exists(Yii::$app->basePath."/web/uploaded/bank/".$oldImage)){
                                    unlink(Yii::$app->basePath."/web/uploaded/bank/".$oldImage);
                                }
                                $transaction->commit();
                                Yii::$app->session->setFlash('success','Data berhasil diubah');
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else { // jika save image gagal
                                $transaction->rollback();
                                Yii::$app->session->setFlash('error','Data gagal diubah');
                                return $this->render('update',['model'=>$model]);
                            }
                        } else { //jika save gagal
                            $transaction->rollback();
                            Yii::$app->session->setFlash('error','Data gagal diubah');
                            return $this->render('update',['model'=>$model]);
                        }


                    } else { //jika image tidak diupdate

                            if($model->saveAll()){
                                $transaction->commit();

                                Yii::$app->session->setFlash('success','Data berhasil diubah');

                                return $this->redirect(['view', 'id' => $model->id]);
                            } else { // Jika model gagal disave
                                $transaction->rollback();

                                Yii::$app->session->setFlash('error','Data gagal diubah');

                                return $this->render('update',['model'=>$model]);
                            }

                    }

                } else { // Jika validate gagal
                    Yii::$app->session->setFlash('error','Validation error');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }


            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else { // if user not 'Admin'
            throw new ForbiddenHttpException;
            
        }
    }

    /**
     * Deletes an existing ModuleBank model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /**
         *
         * Check Roled user if not 'Admin'
         * user can't running this action
         * 
         */
        if(Yii::$app->user->can('Admin')){
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
            
        }  else { // if user not 'Admin'
            throw new ForbiddenHttpException;
            
        }
    }

    
    /**
     * Finds the ModuleBank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleBank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleBank::findOne($id)) !== null) {
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
        /**
         *
         * Check Roled user if not 'Admin'
         * user can't running this action
         * 
         */
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('ModuleSpp');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formModuleSpp', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Check dir exist or not
     * if dir is not exist
     * create dir
     *
     * reference http://youtube.com
     * no return value
     */
    public function checkDir(){

        if(!file_exists(Url::to('@webroot'))) {
            mkdir(Url::to('@webroot/uploaded'),0777,true);
        }
        if(!file_exists(Url::to(Yii::$app->basePath."/web/uploaded/bank"))){
            mkdir(Url::to(Yii::$app->basePath."/web/uploaded/bank"),0777,true);
        }
    }
}
