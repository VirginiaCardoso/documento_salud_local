<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DoclabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doclab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DO_NRO') ?>

    <?= $form->field($model, 'DO_CODCLI') ?>

    <?= $form->field($model, 'DO_OCU') ?>

    <?= $form->field($model, 'DO_RUBRO') ?>

    <?= $form->field($model, 'DO_RUBTIP') ?>

    <?php // echo $form->field($model, 'DO_ESCOL') ?>

    <?php // echo $form->field($model, 'DO_INGRES') ?>

    <?php // echo $form->field($model, 'DO_FUMA') ?>

    <?php // echo $form->field($model, 'DO_FASTAB') ?>

    <?php // echo $form->field($model, 'DO_ALCOH') ?>

    <?php // echo $form->field($model, 'DO_CAGE') ?>

    <?php // echo $form->field($model, 'DO_SEDAN') ?>

    <?php // echo $form->field($model, 'DO_DEPOR') ?>

    <?php // echo $form->field($model, 'DO_SUENIO') ?>

    <?php // echo $form->field($model, 'DO_EAC') ?>

    <?php // echo $form->field($model, 'DO_HIPERT') ?>

    <?php // echo $form->field($model, 'DO_TRATHI') ?>

    <?php // echo $form->field($model, 'DO_COLEST') ?>

    <?php // echo $form->field($model, 'DO_TRATCO') ?>

    <?php // echo $form->field($model, 'DO_DIABET') ?>

    <?php // echo $form->field($model, 'DO_TRATDI') ?>

    <?php // echo $form->field($model, 'DO_ANTQUI') ?>

    <?php // echo $form->field($model, 'DO_ONCO') ?>

    <?php // echo $form->field($model, 'DO_EMBARA') ?>

    <?php // echo $form->field($model, 'DO_ANOVU') ?>

    <?php // echo $form->field($model, 'DO_MENOP') ?>

    <?php // echo $form->field($model, 'DO_TRH') ?>

    <?php // echo $form->field($model, 'DO_ASMAEP') ?>

    <?php // echo $form->field($model, 'DO_PROSTA') ?>

    <?php // echo $form->field($model, 'DO_RUBEO') ?>

    <?php // echo $form->field($model, 'DO_TETANO') ?>

    <?php // echo $form->field($model, 'DO_ANTIGR') ?>

    <?php // echo $form->field($model, 'DO_ANTIHE') ?>

    <?php // echo $form->field($model, 'DO_TRANSF') ?>

    <?php // echo $form->field($model, 'DO_VENER') ?>

    <?php // echo $form->field($model, 'DO_DOLLUM') ?>

    <?php // echo $form->field($model, 'DO_FADI') ?>

    <?php // echo $form->field($model, 'DO_FAHIPE') ?>

    <?php // echo $form->field($model, 'DO_FACARD') ?>

    <?php // echo $form->field($model, 'DO_FAONCO') ?>

    <?php // echo $form->field($model, 'DO_PAENOM') ?>

    <?php // echo $form->field($model, 'DO_MAENOM') ?>

    <?php // echo $form->field($model, 'DO_HEENON') ?>

    <?php // echo $form->field($model, 'DO_NEVOS') ?>

    <?php // echo $form->field($model, 'DO_NODMAN') ?>

    <?php // echo $form->field($model, 'DO_SOPLOS') ?>

    <?php // echo $form->field($model, 'DO_TUMAB') ?>

    <?php // echo $form->field($model, 'DO_TALLA') ?>

    <?php // echo $form->field($model, 'DO_DATOS') ?>

    <?php // echo $form->field($model, 'DO_DATINT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
