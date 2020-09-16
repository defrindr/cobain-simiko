<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <!-- <div class="error-page"> -->
        <div class="error-style container-fluid">
            <div class="row">
                <div class="col-sm-1 col-lg-1">
                    <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>
                </div>
                <div class="col-sm-11">
                    
                    <div class="error-content">

                        <p>
                            <?= nl2br(Html::encode($message)) ?>
                        </p>

                        <p>
                            The above error occurred while the Web server was processing your request.
                            Please contact us if you think this is a server error. Thank you.
                            Meanwhile, you may <a href='<?= Yii::$app->homeUrl ?>'>return to dashboard</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
