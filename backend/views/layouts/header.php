<?php
use yii\helpers\Html;
use common\models\ModuleProfile;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */


$admin = true;
$admin = (Yii::$app->user->identity->role == 10);
$user = ModuleProfile::find()->where('user_id = '.Yii::$app->user->id)->one();

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">SMS</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                 <li>
                 </li>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php

                            if(isset($user->avatar)&& ($user->avatar != "")){
                                if(file_exists(Yii::$app->basePath."/web/uploaded/img-profil/".$user->avatar)){
                                    echo Url::base()."/uploaded/img-profil/".$user->avatar;
                                } else {
                                    echo $directoryAsset.'/img/user2-160x160.jpg';
                                }
                            } else {
                                echo $directoryAsset.'/img/user2-160x160.jpg';
                            }
                            ?>" class="img-circle" alt="User Image" style="max-width: 19px;max-height: 19px"/>
                            <?php
                            if(!empty(Yii::$app->user->identity->username)){
                                $name = \common\models\ModuleUser::find()->where('id='.Yii::$app->user->id)->one();
                                echo $name->profile->nama;
                            } else {
                                echo "Guest ??";
                            }
                            ?>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <?= Html::a(
                                'Profile',
                                ['/profile'],
                                [
                                    'class' => 'btn btn-flat lia'
                                ]
                            ) ?>
                        </li>
                        <li>
                            <?= Html::a(
                                'Ganti Password',
                                ['/site/change-password'],
                                [
                                    'class' => 'btn btn-flat lia',
                                ]
                            ) ?>
                        </li>
                        <li>
                            <?= Html::a(
                                'Sign out',
                                ['/site/logout'],
                                [
                                    'data-method' => 'post',
                                     'class' => 'btn btn-flat lia'
                            ]
                            ) ?>
                        </li>
                    </ul>
              </li>
                <li>
                    
                </li>
            </ul>
        </div>
    </nav>
</header>
