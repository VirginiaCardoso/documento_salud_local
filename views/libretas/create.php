<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Nuevo Trámite';
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
    ]) ?>

</div>
