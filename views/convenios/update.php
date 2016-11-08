<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Convenios */

$this->title = 'Modificar Convenio:  [' . $model->CO_COD. '] ' . $model->CO_DESC;
$this->params['breadcrumbs'][] = ['label' => 'Convenios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CO_COD, 'url' => ['view', 'id' => $model->CO_COD]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="convenios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
