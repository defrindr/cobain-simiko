<?php
// $anu = \backend\controllers\SiteController();
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$list_skin = ['skin-blue-light','skin-green-light','skin-purple-light'];
$ran_skin = $list_skin[random_int(0, 2)];


return [
    'id' => 'app-backend',
    'timeZone' => 'Asia/Jakarta',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => [
      'admin',
      'log',
    ],
    'name' => 'SMKN 1 Jenangan Ponorogo',
    'modules' => [
      'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu', // it can be '@path/to/your/layout'.
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'user_id'
                ],
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'User Akses' // change label
                ],
                'role' =>  [
                    'label' => 'Hak Akses'
                ],
            ]
      ],
      'gridview' => [
          'class' => '\kartik\grid\Module',
          // see settings on http://demos.krajee.com/grid#module
            ],
      'datecontrol' => [
          'class' => '\kartik\datecontrol\Module',
          // see settings on http://demos.krajee.com/datecontrol#module
            ],
      // If you use tree table
      'treemanager' =>  [
          'class' => '\kartik\tree\Module',
          // see settings on http://demos.krajee.com/tree-manager#module
            ],
    ],
    'homeUrl' => "/sekolah/administrator",
    'components' => [
       'authManager' => [
           'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => "/sekolah/administrator",
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            /**
             * Automatic logout after 5 minutes inactive
             */
            // 'authTimeout' => 300,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
           'class' => 'yii\web\UrlManager',
           // Disable index.php
           'showScriptName' => false,
           // Disable r= routes
           'enablePrettyUrl' => true,
           'rules' => array(
              '<controller:\w+>/<id:\d+>' => '<controller>/view',
              '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
              '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
           ),
        ],
        'view' => [
           'theme' => [
               'pathMap' => [
                  '@app/views' => '@app/views'
                ],
              ],
            ],
        'assetManager' => [
        'bundles' => [
            'dmstr\web\AdminLteAsset' => [
                // 'skin' => 'skin-green-light',
                'skin' => $ran_skin,
                ],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            '*',
        ]
    ],
    'params' => $params,
];
