<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DoclabauSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doclabau-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DO_CODLIB') ?>

    <?= $form->field($model, 'DO_VISITA') ?>

    <?= $form->field($model, 'DO_PESO') ?>

    <?= $form->field($model, 'DO_TENAR1') ?>

    <?= $form->field($model, 'DO_TENAR2') ?>

    <?php // echo $form->field($model, 'DO_COLEST') ?>

    <?php // echo $form->field($model, 'DO_GLUCO') ?>

    <?php // echo $form->field($model, 'DO_PAP') ?>

    <?php // echo $form->field($model, 'DO_MAM') ?>

    <?php // echo $form->field($model, 'DO_OBS') ?>

    <?php // echo $form->field($model, 'DO_CINTURA') ?>

    <?php // echo $form->field($model, 'DO_TRIPLI') ?>

    <?php // echo $form->field($model, 'DO_HDL') ?>

    <?php // echo $form->field($model, 'DO_IMC') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
