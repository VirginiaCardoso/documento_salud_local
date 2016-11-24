<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Devoluciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devoluciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DE_NROTRA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DE_IMPORT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DE_FECHA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
