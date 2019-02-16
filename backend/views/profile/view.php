<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ModuleProfile */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Module Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-profile-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Module Profile'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'bio:ntext',
        'no_telp',
        'avatar',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'role',
        'online',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
</div>
