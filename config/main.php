<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-documento_salud',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'documento_salud\controllers',
    'bootstrap' => ['log'],
    'language' => 'es',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
             'loginUrl' => '../../login/web/',/*/www/intranet/modulos/login/web*/
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    
    'modules' => [
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
            'autoWidget' => true,
            'ajaxConversion'=>false,
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            'downloadAction' => 'gridview/export/download',
            'i18n' => []
        ]
        
    ],

    'timeZone' => 'America/Argentina/Buenos_Aires',

    'params' => $params,
];
