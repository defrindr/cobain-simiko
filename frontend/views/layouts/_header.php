<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;


// $logo = Html::img(Url::base().'/uploaded/base/ireng.png',['class' => 'img img-responsive', 'style' => 'max-height:55px;max-width:225px']);
NavBar::begin([
	// 'brandLabel' => $logo,
    'brandLabel' => '<b style="text-shadow:2px 2px 2px #222">'.Yii::$app->name.'</b>',
    'brandUrl' => Yii::$app->homeUrl,
    'id' => 'navbarHead',
    'options' => [
        'class' => 'navbar navbar-inverse navbar-fixed-top nav-costom',
    ],
]);
$menuItems = [
    ['label' => 'Beranda', 'url' => ['/site/index']],
    ['label' => 'Tentang', 'url' => ['/site/about']],
    ['label' => 'Galeri', 'url' => ['/site/galeri']],
    ['label' => 'Kontak', 'url' => ['/site/contact']],
    ['label' => 'Artikel', 'url' => '#'],
];
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right in'],
    'items' => $menuItems,
    'id' => 'item-nav'
]);
NavBar::end();
