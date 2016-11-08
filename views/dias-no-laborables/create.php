<?php

use yii\helpers\Html;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\DiasNoLaborables */

$this->title = 'Crear Día No Laborable';
$this->params['breadcrumbs'][] = ['label' => 'Dias No Laborables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dias-no-laborables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
