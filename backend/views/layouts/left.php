<?php
use common\models\ModuleProfile;
use common\models\ModuleKelas;
use yii\helpers\Url;
$admin = true;
$guru = true;
$siswa = true;
$admin = (Yii::$app->user->identity->role == 10);
$guru = (Yii::$app->user->identity->role == 20);
$siswa = (Yii::$app->user->identity->role == 30);
$user = ModuleProfile::find()->where('user_id = '.Yii::$app->user->id)->one();

$check_kelas = ModuleKelas::find()->where(['guru_id'=>Yii::$app->user->id])->one();
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
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
                ?>" class="img-circle" alt="User Image" style="max-width: 55px;max-height: 55px"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Side Menu', 'options' => ['class' => 'header']],
                    ['label'=>'Dashboard','url'=>Url::base(), 'icon' => 'dashboard'],
                    [
                        'label' => 'Admin Menu', 
                        'icon'=>'dashboard', 
                        'url'=>'#',
                        'visible' => $admin,
                        'items' => [
                            ['label' => 'Bank', 'url' => ['/bank'], 'icon' => 'dashboard'],
                            ['label' => 'berita', 'url' => ['/berita'], 'icon' => 'dashboard'],
                            ['label' => 'Galeri', 'url' => ['/galeri'], 'icon' => 'dashboard'],
                            ['label' => 'Profile Manage', 'url' => ['/profile/all'], 'icon' => 'dashboard'],
                            ['label' => 'Siswa', 'url' => ['/siswa'], 'icon' => 'dashboard'],
                            ['label' => 'User Manage', 'url' => ['/user-manage'], 'icon' => 'dashboard'],
                        ]
                    ],
                    ['label' => 'Guru', 'url' => ['/guru'], 'icon' => 'dashboard'],
                    ['label'=>'Jadwal','url'=> ['/jadwal'], 'icon'=>'calendar'],
                    [
                        'label' => 'Jurusan',
                        'url' => ['/jurusan'],
                        'icon' => 'dashboard',
                    ],
                    ['label' => 'Kelas', 'url' => ['/kelas'], 'icon' => 'dashboard', 'visible' => ($check_kelas != [] or $admin) ],
                    ['label' => 'Mata Pelajaran', 'icon'=> 'dashboard','url'=>['/mata-pelajaran']],
                    [
                        'label' => 'Materi Fitur',
                        'icon'=>'dashboard', 
                        'url'=>'#',
                        'visible'=> ($admin or $guru),
                        'items' => [
                            ['label' => 'Materi', 'url' => ['/materi'], 'icon' => 'dashboard'],
                            ['label' => 'Materi File', 'url' => ['/materi-file'], 'icon' => 'dashboard'],
                            // ['label' => 'Materi Komentar', 'url' => ['/materi-komentar'], 'icon' => 'dashboard'],
                            ['label' => 'Materi Bab', 'url' => ['/materi-kategori'], 'icon' => 'dashboard'],
                            [
                                'label' => 'Soal',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Materi Soal', 'url' => ['/materi-soal']],
                                    ['label' => 'Materi Soal File', 'url' => ['/materi-soal-file']],
                                    ['label' => 'Materi Jawaban', 'url' => ['/materi-soal-jawaban']],
                                ]
                            ],
                        ],
                    ],
                    ['label' => 'Nilai','url'=>['/nilai'], 'visible' => $siswa],
                    ['label' => 'Pembayaran SPP', 'icon'=> 'dashboard','url'=>['/spp']],
                ],
            ]
        ) ?>

    </section>

</aside>