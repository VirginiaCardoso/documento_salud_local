<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

$this->title = 'Update Pool Lab: ' . $model->PO_NROLIB;
$this->params['breadcrumbs'][] = ['label' => 'Pool Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PO_NROLIB, 'url' => ['view', 'id' => $model->PO_NROLIB]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pool-lab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
