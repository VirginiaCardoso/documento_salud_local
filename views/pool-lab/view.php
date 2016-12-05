<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

$this->title = $model->PO_NROLIB;
$this->params['breadcrumbs'][] = ['label' => 'Pool Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pool-lab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PO_NROLIB], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PO_NROLIB], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PO_NROLIB',
            'PO_FEC',
            'PO_HORA',
            'PO_COLEST',
            'PO_GLUCOSA',
            'PO_MUESTRA',
            'PO_LISTO',
        ],
    ]) ?>

</div>
