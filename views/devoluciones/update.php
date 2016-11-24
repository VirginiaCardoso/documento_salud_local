<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Devoluciones */

$this->title = 'Update Devoluciones: ' . $model->DE_COD;
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DE_COD, 'url' => ['view', 'id' => $model->DE_COD]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devoluciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
