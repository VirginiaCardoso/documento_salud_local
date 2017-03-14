<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */

$this->title = 'Visita Médico';
//$this->params['breadcrumbs'][] = ['label' => 'Visitas ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclabau-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lib' => $lib,
        'anterior' => $anterior,
        'doc' => $doc,
        'client' => $client,
        'from' => 0,
    ]) ?>

</div>
