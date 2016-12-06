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

    <h1>Extracción y Muestra</h1>


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


    <h4> Confirma la extracción y toma de muestra? </h4>
    <?= Html::a('Confirmar', ['confirmar-muestra', 'id' => $model->PO_NROLIB], ['class' => 'btn btn-primary']) ?>

</div>
