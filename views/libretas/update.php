<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Update Libretas: ' . $model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->LI_NRO, 'url' => ['view', 'id' => $model->LI_NRO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="libretas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
