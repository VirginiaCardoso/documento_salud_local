<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */

$this->title = $model->CL_COD;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CL_COD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CL_COD], [
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
            'CL_COD',
            'CL_HC',
            'CL_TIPDOC',
            'CL_NUMDOC',
            'CL_APENOM',
            'CL_FECNAC',
            'CL_CODLOC',
            'CL_DOMICI',
            'CL_TEL',
            'CL_LUGTRA',
            'CL_NROHAB',
            'CL_SEXO',
            'CL_ESTCIV',
            'CL_IMG',
            'CL_EMAIL:email',
        ],
    ]) ?>

</div>
