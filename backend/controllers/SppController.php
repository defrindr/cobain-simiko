<?php

namespace backend\controllers;

use Yii;
use common\models\ModuleSpp;
use common\models\ModuleSppSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\helpers\Url;




/**
 * SppController implements the CRUD actions for ModuleSpp model.
 */
class SppController extends Controller
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all ModuleSpp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModuleSppSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all ModuleSpp models.
     * @return mixed
     */
    public function actionDataRestore()
    {
        $searchModel = new ModuleSppSearch();
        $dataProvider = $searchModel->searchRestore(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestore($id){
        $model = ModuleSpp::findDeleted($id)->one();
        if($model->restoreWithRelated()){
            Yii::$app->session->setFlash('success','Data berhasil direstore');
        } else {
            Yii::$app->session->setFlash('success','Data gagal direstore');
        } return $this->redirect(['index']);
    }




    /**
     * Displays a single ModuleSpp model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModuleSpp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ModuleSpp();
        if(Yii::$app->user->can('create.spp')){
            if ($model->loadAll(Yii::$app->request->post())) {
                $model->image = UploadedFile::getInstance($model,'image');
                $model->siswa_id = Yii::$app->user->id;
                $model->status = 0;
                $model->total = $model->spp+$model->tabungan_prakerin+$model->tabungan_study_tour;
                $img_name = Yii::$app->user->id."_".time()."_".random_int(0,100)."_".$model->tahun.".".$model->image->extension;
                $model->bukti_bayar = $img_name;
                $this->checkDir();
                if($model->validate()){
                    if($model->saveAll()){
                        $model->image->saveAs(Url::to('@backend/web/uploaded/spp/'.$img_name));
                        Yii::$app->session->setFlash('success','Berhasil mengirim pengajuan');
                    }else {
                        Yii::$app->session->setFlash('error','Gagal mengirim pengajuan');
                    }
                } else {
                    Yii::$app->session->setFlash('error','Error Validasi');
                }
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
            
        }
    }

    /**
     * Updates an existing ModuleSpp model.
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

    public function approve($id){
        $model->findModel($id);

        if(Yii::$app->user->can('spp.approve')){
            $model->status = 1;
            if($model->save()){
                Yii::$app->session->setFlash('success','Data telah divalidasi');
            } else {
                Yii::$app->session->setFlash('error','Status data gagal diubah');
            }
            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing ModuleSpp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = ModuleSpp::find()->where('id='.$id)->one();
        if((($model->created_by == Yii::$app->user->id) or Yii::$app->user->can('Admin'))){
            if(file_exists(Url::to('@backend/web/uploaded/spp/'.$model->bukti_bayar))){
                unlink(Url::to('@backend/web/uploaded/spp/'.$model->bukti_bayar));
            }
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success','Berhasil dihapus');
        }else {
            throw new ForbiddenHttpException;
        }

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export ModuleSpp information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf() {
        $model = ModuleSpp::find()->all();
        // $model = $this->findModel($id);
        // 
        $searchModel = new ModuleSppSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $content = $this->renderAjax('_pdf', [
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    
    /**
     * Finds the ModuleSpp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ModuleSpp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleSpp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * membuat action untuk mengecheck apakah directori ada atau tidak
     */
    public function checkDir(){
        if(!file_exists(Url::to("@backend")."/web/uploaded/")){
            mkdir(Url::to("@backend")."/web/uploaded/");
        }
        if(!file_exists(Url::to("@backend")."/web/uploaded/spp/")){
            mkdir(Url::to("@backend")."/web/uploaded/spp/");
        }
    }




}
