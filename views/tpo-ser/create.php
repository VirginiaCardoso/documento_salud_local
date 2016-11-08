<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSer */

$this->title = 'Nuevo Tipo Trámite';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Trámites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpo-ser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
