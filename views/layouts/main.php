<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use documento_salud\assets\AppAsset;
use common\widgets\Alert;
use kartik\nav\NavX;
use app\models\Legajo;
use yii\helpers\Url;
use kartik\dialog\Dialog;

echo Dialog::widget(['libName' => 'krajeeDialog']);
echo Dialog::widget([
    'libName' => 'krajeeDialogExito',
    'options' => [
        'type' => Dialog::TYPE_SUCCESS,
        'title' => 'Documento Salud Laboral'],
]);
echo Dialog::widget([
    'libName' => 'krajeeDialogError',
    'options' => [
        'type' => Dialog::TYPE_WARNING,
        'title' => 'Documento Salud Laboral'],
]);

AppAsset::register($this);

if (Yii::$app->session->hasFlash('exito')) {
    $this->registerJs('krajeeDialogExito.alert("'.Yii::$app->session->getFlash('exito').'");');
}

if (Yii::$app->session->hasFlash('error')) {
    $this->registerJs('krajeeDialogError.alert("'.Yii::$app->session->getFlash('error').'");');
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap"><?php

    if (Yii::$app->user->isGuest) {
            Yii::$app->user->setReturnUrl($_SERVER["REQUEST_URI"]);
            $user_item = ['label' => 'Login', 'url' => Yii::$app->user->loginUrl];
        } else {
            $user_item = 
             Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->LE_APENOM . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm();
        }
    
    // Usage with bootstrap nav pills.
    echo NavX::widget([
        'options'=>['class'=>'nav nav-pills'],
        'items' => [
            ['label' => 'Administración', 'items' =>
                [
                    ['label' => 'Inicio de trámite', 'url' =>  ['/libretas/']],//['/eventos/index']],
                    ['label' => 'Resultado de estudios comentarios', 'url' => '#'],//['/prestamos/index']],
                    ['label' => 'Emisión virtual', 'url' => '#'],//['/prestamos/devoluciones']],
                ]
            ],
            ['label' => 'Médico', 'items' =>
                [
                    ['label' => 'Consulta médica', 'url' => '#'],//['/reportes/pedidos/']],
                ]
            ],
            ['label' => 'Tesorería',  'items' =>
                [
                    ['label' => 'Anular trámite', 'url' =>  '#'],
                    ['label' => 'Devolución', 'url' => '#'],
                    ['label' => 'Reimpresión de comprobantes', 'url' => '#'],//['/prestamos/index']],
                    ['label' => 'Caja diaria', 'url' => '#'],//['/prestamos/devoluciones']],
                     ['label' => 'Resumen', 'url' => '#'],//['/eventos/index']],
                    ['label' => 'Planilla mensual', 'url' => '#'],//['/prestamos/index']],
                    
                ],
            ],
            ['label' => 'Configuración',  'items' =>
                [   
                    ['label' => 'Usuarios', 'url' => '#'],
                    ['label' => 'Catálogos',   'items' =>
                        [
                            ['label' => 'Convenios', 'url' => ['/convenios/']],
                            ['label' => 'Clases', 'url' => ['/clases']],
                            ['label' => 'Tipos de trámites', 'url' => ['/tpo-ser']],
                            ['label' => 'Días no laborables', 'url' => ['/dias-no-laborables/']],
                            ['label' => 'Clientes', 'url' => ['/clientes/']],
                            
                        ],
                    ],
                    
                ],
            ],
            
            $user_item,
        ],
        'encodeLabels' => false
    ]);
    ?>
<div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<footer class="footer">
    <div class="rayita"></div>
    <div class="div_footer">
        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/logo-hospital-byn.png" witdh="" height="35px">
        <span>Dirección: Estomba 968, Bahía Blanca, Argentina / Teléfono: (0291) 459-8484
        Hospital Municipal de Agudos Dr. Leónidas Lucero / 2016 Todos los derechos reservados
        </span>
        <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/logo-bahia-byn.png" witdh="" height="32px">
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
