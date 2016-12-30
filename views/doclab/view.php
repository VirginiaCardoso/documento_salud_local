<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */

$this->title = $model->DO_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Doclabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->DO_NRO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->DO_NRO], [
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
            'DO_NRO',
            'DO_CODCLI',
            'DO_OCU',
            'DO_RUBRO',
            'DO_RUBTIP',
            'DO_ESCOL',
            'DO_INGRES',
            'DO_FUMA',
            'DO_FASTAB',
            'DO_ALCOH',
            'DO_CAGE',
            'DO_SEDAN',
            'DO_DEPOR',
            'DO_SUENIO',
            'DO_EAC',
            'DO_HIPERT',
            'DO_TRATHI',
            'DO_COLEST',
            'DO_TRATCO',
            'DO_DIABET',
            'DO_TRATDI',
            'DO_ANTQUI',
            'DO_ONCO',
            'DO_EMBARA',
            'DO_ANOVU',
            'DO_MENOP',
            'DO_TRH',
            'DO_ASMAEP',
            'DO_PROSTA',
            'DO_RUBEO',
            'DO_TETANO',
            'DO_ANTIGR',
            'DO_ANTIHE',
            'DO_TRANSF',
            'DO_VENER',
            'DO_DOLLUM',
            'DO_FADI',
            'DO_FAHIPE',
            'DO_FACARD',
            'DO_FAONCO',
            'DO_PAENOM',
            'DO_MAENOM',
            'DO_HEENON',
            'DO_NEVOS',
            'DO_NODMAN',
            'DO_SOPLOS',
            'DO_TUMAB',
            'DO_TALLA',
            'DO_DATOS',
            'DO_DATINT',
        ],
    ]) ?>

</div>
