<?php
use yii\helpers\Html;
use yii\helpers\Url;


?>

<div class="box box-materi" style="position: relative;">
        <h3>Komentar</h3>
        <hr>
        <?php if($providerModuleMateriKomentar->totalCount == 0){
            echo "Belum ada komentar.";
        }else {
            $moduleKomentar = \common\models\ModuleMateriKomentar::find()->where('materi_id='.$model->id)->all();
            foreach ($moduleKomentar as $komentar) {
                // $photo = \common\models\ModuleProfile::find()->where('user_id='.$komentar->user_id)->one();
             ?>
                <div style="border: 1px solid #aaa;border-left:3px solid <?php $a=['red','green','blue','purple','yellow']; echo $a[random_int(0,2)]; ?>;margin: 4px 0;padding: 20px;position: relative;">
                    <div class="row">
                        <div class="col-sm-2 col-xs-3 col-md-1 col-lg-1">
                            <?= Html::img(Url::base()."/uploaded/img-profil/".$komentar->profile->avatar,['class'=>'img img-circle','style'=>'width:60px;height:60px;']) ?>
                        </div>
                        <div class="col-sm-10 col-xs-9 col-md-11 col-lg-11">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span style="font-size: 18px">
                                        <?= $komentar->profile->nama ?>
                                    </span>
                                    <?php if($komentar->created_by == $model->created_by) {echo '<p class="badge label-primary" style="padding:3px 12px;border:0;display:inline-block">creator</p>'; } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                        <?= date('H:i:s l F o',$komentar->created_at); ?>
                                </div>
                            </div>
                        </div>
                        <?php if($komentar->materi->created_by == Yii::$app->user->id or Yii::$app->user->can('Admin') or $komentar->created_by == Yii::$app->user->id)
                        { 
                            echo Html::a('<span class="glyphicon glyphicon-trash"></span>',['delete-komentar','id'=>$komentar->id],['style'=>'position:absolute;top:20px;right:15px']);
                         } ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <span style="font-size: 14px"><b><?= $komentar->subject ?></b></span>
                            <br/>
                            <?= $komentar->komentar ?>
                        </div>
                    </div>
                </div>

            <?php }
        } ?>
    </div>
