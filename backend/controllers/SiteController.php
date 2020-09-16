<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $rand_num;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'foreColor' => 115006,
                'backColor' => 333333,
                'height' => 30,
                'maxLength' => 6,
                'minLength' => 4,
                'offset' => 2,
                'testLimit' => 1,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role==30){
            $model = \common\models\ModuleSiswa::find()->where('user_id='.Yii::$app->user->id)->one()->kelas->moduleMateris;
            return $this->render('index_siswa',['model'=>$model]);
            
        }else{
            return $this->render('index');
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()/*loginBack()*/) {
            $user = \common\models\ModuleUser::find()->where('id='.Yii::$app->user->id)->one();
            $user->last_login = time();
            $user->save();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }



    public function actionChangePassword()
    {
        if(($modelUser = User::findOne(trim(Yii::$app->user->id))) === null){
            throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
        } else {
            $model = new \app\models\changePasswordForm();
            if($model->load(Yii::$app->request->post()))
            {
                if($model->validate())
                {
                    // var_dump(Yii::$app->security->generatePasswordHash($model->old_pass)."\n\n\n".$modelUser->password_hash);
                    // exit();
                    if(Yii::$app->security->validatePassword($model->old_pass,$modelUser->password_hash))
                    {
                        $modelUser->setPassword($model->new_pass);
                        if($modelUser->save(false))
                        {
                            Yii::$app->session->setFlash('success','Password berhasil diganti');
                            return $this->redirect(['index']);
                        } else 
                        {
                            Yii::$app->session->setFlash('danger','Error when save new password');
                            return $this->redirect(['index']);
                        }
                    } else 
                    {
                        Yii::$app->session->setFlash('error','Old Password is not valid');
                        return $this->render('change_password',['model'=>$model]);
                    }
                    
                } else 
                {
                    Yii::$app->session->setFlash('error','Validasi form error');
                    return $this->render('change_password',['model'=>$model]);
                }
            } else 
            {
               return $this->render('change_password',['model'=>$model]);
                
            }
        }

        
    }




    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
