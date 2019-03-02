<?php
use common\models\ModuleProfile;
use yii\helpers\Url;
$admin = true;
$guru = true;
$siswa = true;
$admin = (Yii::$app->user->identity->role == 10);
$guru = (Yii::$app->user->identity->role == 20);
$siswa = (Yii::$app->user->identity->role == 30);
$user = ModuleProfile::find()->where('user_id = '.Yii::$app->user->id)->one();
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
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Admin fitur', 
                        'icon'=>'dashboard', 
                        'url'=>'#',
                        'visible' => $admin,
                        'items' => [
                            ['label' => 'berita', 'url' => ['/berita'], 'icon' => 'dashboard'],
                            ['label' => 'User Manage', 'url' => ['/user-manage'], 'icon' => 'dashboard'],
                            ['label' => 'Kelas', 'url' => ['/kelas'], 'icon' => 'dashboard'],
                            ['label' => 'Bank', 'url' => ['/bank'], 'icon' => 'dashboard'],
                            ['label' => 'Siswa', 'url' => ['/siswa'], 'icon' => 'dashboard'],
                            ['label' => 'Profile Manage', 'url' => ['/profile/all'], 'icon' => 'dashboard'],
                            
                            ['label' => 'Galeri', 'url' => ['/galeri'], 'icon' => 'dashboard'],
                        ]
                    ],
                    ['label' => 'Guru', 'url' => ['/guru'], 'icon' => 'dashboard'],
                    [
                        'label' => 'Jurusan',
                        'url' => ['/jurusan'],
                        'icon' => 'dashboard',
                    ],
                    [
                        'label' => 'Materi Fitur',
                        'icon'=>'dashboard', 
                        'url'=>'#',
                        'items' => [
                            ['label' => 'Materi', 'url' => ['/materi'], 'icon' => 'dashboard'],
                            ['label' => 'Materi File', 'url' => ['/materi-file'], 'icon' => 'dashboard'],
                            ['label' => 'Materi Komentar', 'url' => ['/materi-komentar'], 'icon' => 'dashboard'],
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
                    ['label' => 'Menu SPP', 'icon'=> 'dashboard','url'=>['/spp']],
                    ['label' => 'Mata Pelajaran', 'icon'=> 'dashboard','url'=>['/mata-pelajaran']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>