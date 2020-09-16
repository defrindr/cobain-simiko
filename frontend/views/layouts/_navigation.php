<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

$logo = Html::img(Url::base(). '/administrator/uploaded/base/smk.png',['class' => 'img img-responsive', 'style' => 'max-height:55px;max-width:225px']);
NavBar::begin([
	'brandLabel' => $logo,
    // 'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'id' => 'navbarHead',
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top nav-costom',
    ],
]);
$menuItems = [
    ['label' => 'Beranda', 'url' => ['/site/index']],
    ['label' => 'Tentang', 'url' => ['/site/about']],
    ['label' => 'Galeri', 'url' => ['/galeri']],
    ['label' => 'Kontak', 'url' => ['/site/contact']],
    ['label' => 'Artikel', 'url' => ['/artikel']],
    ['label' => 'Login', 'url'=>['/administrator']],
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right in'],
    'items' => $menuItems,
    'id' => 'item-nav'
]);
NavBar::end();
