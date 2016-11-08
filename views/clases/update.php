<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clases */

$this->title = 'Modificar Clase:  [' . $model->CL_COD. '] ' . $model->CL_DESC;
$this->params['breadcrumbs'][] = ['label' => 'Clases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CL_COD, 'url' => ['view', 'id' => $model->CL_COD]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="clases-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
