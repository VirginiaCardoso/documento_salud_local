<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DevolucionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devoluciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DE_COD') ?>

    <?= $form->field($model, 'DE_NROTRA') ?>

    <?= $form->field($model, 'DE_IMPORT') ?>

    <?= $form->field($model, 'DE_FECHA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
