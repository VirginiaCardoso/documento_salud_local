<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DiasNoLaborables */

$this->title = "[".\Yii::$app->formatter->asDate($model->DI_FEC)."] ";
$this->params['breadcrumbs'][] = ['label' => 'Dias No Laborables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dias-no-laborables-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <?= Html::a('Modificar', ['update', 'id' => $model->DI_FEC], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->DI_FEC], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DI_FEC',
            'DI_DESCRI',
        ],
    ]) ?>

</div>
