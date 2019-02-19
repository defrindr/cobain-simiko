<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


$admin = true;
$admin = (Yii::$app->user->identity->role == 10);

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">SMA</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                 <li>
                    <?= Html::a(
                        'Profile',
                        ['/profile'],
                        ['class' => 'btn btn-flat', 'style' => 'border:0']
                    ) ?>
                 </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <li>
                    <?= Html::a(
                        'Sign out',
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'btn btn-flat', 'style' => 'border:0']
                    ) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
