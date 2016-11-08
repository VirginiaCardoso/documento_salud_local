<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpo-ser-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TS_COD') ?>

    <?= $form->field($model, 'TS_DESC') ?>

    <?= $form->field($model, 'TS_IMP') ?>

    <?= $form->field($model, 'TS_CLASE') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
