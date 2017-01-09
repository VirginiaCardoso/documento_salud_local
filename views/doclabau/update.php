<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */

$this->title = 'Update Doclabau: ' . $model->DO_CODLIB;
$this->params['breadcrumbs'][] = ['label' => 'Doclabaus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DO_CODLIB, 'url' => ['view', 'id' => $model->DO_CODLIB]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doclabau-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
