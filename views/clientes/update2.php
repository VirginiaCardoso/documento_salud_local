<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */

$this->title = 'Modificar Cliente: ' . $model->CL_COD;
$this->params['breadcrumbs'][] = ['label' => 'Inicio Trámite', 'url' => ['libretas/index']];
$this->params['breadcrumbs'][] = ['label' => 'Nuevo Trámite', 'url' => ['libretas/create']];
$this->params['breadcrumbs'][] = ['label' => $model->CL_COD, 'url' => ['view', 'id' => $model->CL_COD]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="clientes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
