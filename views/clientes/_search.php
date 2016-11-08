<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\ClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CL_COD') ?>

    <?= $form->field($model, 'CL_HC') ?>

    <?= $form->field($model, 'CL_TIPDOC') ?>

    <?= $form->field($model, 'CL_NUMDOC') ?>

    <?= $form->field($model, 'CL_APENOM') ?>

    <?php // echo $form->field($model, 'CL_FECNAC') ?>

    <?php // echo $form->field($model, 'CL_CODLOC') ?>

    <?php // echo $form->field($model, 'CL_DOMICI') ?>

    <?php // echo $form->field($model, 'CL_TEL') ?>

    <?php // echo $form->field($model, 'CL_LUGTRA') ?>

    <?php // echo $form->field($model, 'CL_NROHAB') ?>

    <?php // echo $form->field($model, 'CL_SEXO') ?>

    <?php // echo $form->field($model, 'CL_ESTCIV') ?>

    <?php // echo $form->field($model, 'CL_IMG') ?>

    <?php // echo $form->field($model, 'CL_EMAIL') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
