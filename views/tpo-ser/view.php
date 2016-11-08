<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSer */

$this->title = '[' . $model->TS_COD. '] ' . $model->TS_DESC;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Trámites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tpo-ser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->TS_COD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->TS_COD], [
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
            'TS_COD',
            'TS_DESC',
            'TS_IMP',
            'TS_CLASE',
        ],
    ]) ?>

</div>
