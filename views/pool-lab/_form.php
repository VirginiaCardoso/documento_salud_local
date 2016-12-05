<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pool-lab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PO_NROLIB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PO_FEC')->textInput() ?>

    <?= $form->field($model, 'PO_HORA')->textInput() ?>

    <?= $form->field($model, 'PO_COLEST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PO_GLUCOSA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PO_MUESTRA')->textInput() ?>

    <?= $form->field($model, 'PO_LISTO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
