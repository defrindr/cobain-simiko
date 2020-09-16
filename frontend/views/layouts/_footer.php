<?php 
use yii\helpers\Html;

?>
<footer id="foot">
    <?= $this->render('_banner') ?>
    <div class="container-fluid footer">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <p class="copyright"><?= /*'Powered by <a href="#">Smkn 1 Jenangan</a>.'.*/'Themes <a href="#">Luxury</a> by <a href="#">Defri Indra</a>' ?></p>
            </div>
        </div>
    </div>
</footer>