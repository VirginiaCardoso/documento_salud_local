<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSer */

$this->title = 'Modificar Tipo Trámite: [' . $model->TS_COD. '] ' . $model->TS_DESC;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Trámites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TS_COD, 'url' => ['view', 'id' => $model->TS_COD]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tpo-ser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
