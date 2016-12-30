<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */

$this->title = 'Update Doclab: ' . $model->DO_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Doclabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DO_NRO, 'url' => ['view', 'id' => $model->DO_NRO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doclab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
