<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pool-lab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PO_NROLIB') ?>

    <?= $form->field($model, 'PO_FEC') ?>

    <?= $form->field($model, 'PO_HORA') ?>

    <?= $form->field($model, 'PO_COLEST') ?>

    <?= $form->field($model, 'PO_GLUCOSA') ?>

    <?php // echo $form->field($model, 'PO_MUESTRA') ?>

    <?php // echo $form->field($model, 'PO_LISTO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
