<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DiasNoLaborables */

$this->title = "Modificar [".\Yii::$app->formatter->asDate($model->DI_FEC)."]";
$this->params['breadcrumbs'][] = ['label' => 'Dias No Laborables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DI_FEC, 'url' => ['view', 'id' => $model->DI_FEC]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="dias-no-laborables-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
