<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="body-content">

        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-lg-offset-0 col-md-offset-2 col-sm-6">
                    <div class="kategori">
                        <h4 class="kategori-title">Introduction</h4>
                        <iframe height="300px" width="100%" src="https://www.youtube.com/embed/hNw3gGdcmuQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 0 0 10px 10px"></iframe>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <h3 class="index-title"><i class="glyphicon glyphicon-asterisk"></i> New Artikel</h3>
                    <div class="row">
                        <?php foreach ($newArtikel as $Artikel) { ?>
                        <a href="<?= Url::to(['/artikel/view','id'=>$Artikel->id]) ?>">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="height: auto;margin:2rem 0">
                                <div class="artikel">
                                    <div class="row">
                                        <div class="berita-creator">
                                            <i class="glyphicon glyphicon-user"></i> <?= \common\models\ModuleProfile::findOne($Artikel->created_by)->nama ?>
                                            <br>
                                            <i class="glyphicon glyphicon-time"></i> <?= date("d M Y",$Artikel->created_at) ?>
                                            <br>
                                            <i class="glyphicon glyphicon-tags"></i> <?= $Artikel->beritaKategori->nama ?>
                                        </div>
                                    </div>
                                    <div class="inner text-center">
                                        <?= $Artikel->judul ?>

                                        <?php if(($Artikel->gambar != "") and file_exists(Url::to('@webroot/uploaded/berita/'.$Artikel->gambar))){ ?>
                                            <?= Html::img(Url::to('@web/uploaded/berita/'.$Artikel->gambar),['class'=> 'img img-responsive  img-galeri img-circle artikel-image','style'=>'height:70px;width:70px;margin:10px auto']) ?>

                                        <?php } else { ?>
                                            <?= Html::img(Url::to('@web/uploaded/base/no-thumbnail.jpg'),['class'=>'img img-responsive img-circle artikel-image','style'=>'height:70px;width:70px;margin:10px auto']) ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php } ?>
                    </div>
                        <?= Html::a("Artikel Lain <i class='glyphicon glyphicon-arrow-right'></i>",['/artikel'],['class'=> 'more','style'=>'color:#fff;']) ?>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <h3 class="index-title"> <i class="glyphicon glyphicon-camera"></i> New Image In Galeri</h3>
                <?php foreach ($newGaleri as $galeri) {?>
                     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                        <div class="card showModalButton card-shadow artikel">
                            <?= Html::img(Url::base()."/uploaded/galeri/".$galeri->link, ['style' => 'margin:0 auto','class'=>'img img-responsive showModalButton','onclick'=>'prevImages(this)','alt' => $galeri->judul]) ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
                <?= Html::a("Gambar Lain <i class='glyphicon glyphicon-arrow-right'></i>",['/galeri'],['class'=> 'more','style'=>'color:#fff;']) ?>
        </div>
    </div>
</div>
