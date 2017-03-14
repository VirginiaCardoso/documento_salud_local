<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */

$this->title = 'Actualizar ';
$this->params['breadcrumbs'][] = ['label' => 'Historial de visitas', 'url' => ['doclabau/index', 'codcli' => $model->DO_CODCLI]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="doclabau-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
                'lib' => $lib,
                'anterior' => $anterior,
                'doc' => $doc,
                'client' => $client,
                'from' => 1,
    ]) ?>

</div>
