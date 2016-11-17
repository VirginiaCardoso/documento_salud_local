<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Libreta: '.$model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->LI_NRO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->LI_NRO], [
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
            'LI_NRO',
            'LI_COCLI',
            'LI_FECPED:date',
            //'LI_TPOSER',
            [
                'attribute' => 'LI_TPOSER',
                'format' => 'text',
                'value' => $model->lITPOSER?$model->lITPOSER->TS_DESC:'',
            ],
            //'LI_CONVEN',
            [
                'attribute' => 'LI_CONVEN',
                'format' => 'text',
                'value' => $model->lICONVEN?$model->lICONVEN->CO_DESC:'',
            ],
            'LI_CONSULT',
            'LI_ESTUD',
            'LI_IMPR',
            'LI_FECRET',
            'LI_IMPORTE',
            'LI_FECIMP',
            'LI_FECVTO',
            'LI_COMP',
            'LI_ANULADA',
            'LI_ADIC',
            'LI_IMPADI',
            'LI_REIMPR',
            'LI_SELECT',
            'LI_HORA',
            
        ],
    ]) ?>

</div>
