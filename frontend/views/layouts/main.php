<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Carousel;
use \yii\helpers\Url;

AppAsset::register($this);
\app\assets\fontAwesomeAsset::register($this);

$carousel = [
    [
        'content' => '',
        'caption' => '<h1>SMKN 1 Jenangan</h1><br><p>Merupakan sebuah Sekolah  Menengah Atas yang berlokasi di jln. Niken Gandini , Jenangan Ponorogo .</p><a href="<span id="more-info"></span>" <a class="btn btn-caption" href="site/about">More Info</a>',
        'options' => ['class'=>'slide','style' => 'background-image:url('.\yii\helpers\Url::to("@web/uploaded/base/head.png").')'],
    ],
    [
        'content' => '',
        'caption' => '<h1>SMKN 1 Jenangan</h1><br><p>Merupakan sebuah Sekolah  Menengah Atas yang berlokasi di jln. Niken Gandini , Jenangan Ponorogo .</p><a href="<span id="more-info"></span>" <a class="btn btn-caption" href="site/about">More Info</a>',
        'options' => ['class'=>'slide','style' => 'background-image:url('.\yii\helpers\Url::to("@web/uploaded/base/head2.png").')'],
    ]
];
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <?= $this->render('_navigation'); ?>
</header>

<?php if(Url::to()==Url::base()."/" or Url::to() == Url::base().'/site/index'){ ?>

<section class="slider">
    <?=  \yii\bootstrap\Carousel::widget([
        'id'=>'myCarousel',
        // 'controls' => false,
        'items' => $carousel,
    ]); ?>
</section>

<?php }else { ?>

    <div class="header-green">
            <div class="another">
                <h2>SMKN 1 Jenangan</h2>
                <span> Jaya Luar Biasa</span>
            </div>
    </div>

<?php } ?>
<div class="wrap">
    <?php if(!(Url::to()==Url::base()."/" or Url::to() == Url::base().'/site/index')){ ?>
    <div class="container content">
        <h3><?= Html::encode($this->title) ?></h3>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <?php }else{ ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <?php } ?>
</div>

<?php // echo $this->render('maps') ?>


<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
