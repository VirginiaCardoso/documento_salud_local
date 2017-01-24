<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */

$this->title = $model->DO_CODLIB;
$this->params['breadcrumbs'][] = ['label' => 'Doclabaus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclabau-view">

    <h1>Este no queda asi</h1>

    <p>
    <!--   <?= Html::encode($this->title) ?><  <?= Html::a('Update', ['update', 'id' => $model->DO_CODLIB], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->DO_CODLIB], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DO_CODLIB',
            'DO_VISITA',
            'DO_PESO',
            'DO_TENAR1',
            'DO_TENAR2',
            'DO_COLEST',
            'DO_GLUCO',
            'DO_PAP',
            'DO_MAM',
            'DO_OBS',
            'DO_CINTURA',
            'DO_TRIGLI',
            'DO_HDL',
            'DO_IMC',
        ],
    ]) ?>

</div>
