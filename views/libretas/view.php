<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = $model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->LI_NRO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->LI_NRO], [
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
            'LI_NRO',
            'LI_COCLI',
            'LI_FECPED',
            'LI_TPOSER',
            'LI_CONVEN',
            'LI_CONSULT',
            'LI_ESTUD',
            'LI_IMPR',
            'LI_FECRET',
            'LI_IMPORTE',
     
            'LI_FECVTO',
            'LI_COMP',
            'LI_ANULADA',
            'LI_ADIC',
            'LI_IMPADI',
            'LI_REIMPR',
            'LI_SELECT',
            'LI_HORA',
            'LI_FHIMPOR',
        ],
    ]) ?>

</div>
