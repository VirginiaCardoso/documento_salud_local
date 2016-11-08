<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libretas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LI_NRO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_COCLI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_FECPED')->textInput() ?>

    <?= $form->field($model, 'LI_TPOSER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_CONVEN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_CONSULT')->textInput() ?>

    <?= $form->field($model, 'LI_ESTUD')->textInput() ?>

    <?= $form->field($model, 'LI_IMPR')->textInput() ?>

    <?= $form->field($model, 'LI_FECRET')->textInput() ?>

    <?= $form->field($model, 'LI_IMPORTE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_FECIMP')->textInput() ?>

    <?= $form->field($model, 'LI_FECVTO')->textInput() ?>

    <?= $form->field($model, 'LI_COMP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_ANULADA')->textInput() ?>

    <?= $form->field($model, 'LI_ADIC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_IMPADI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LI_REIMPR')->textInput() ?>

    <?= $form->field($model, 'LI_SELECT')->textInput() ?>

    <?= $form->field($model, 'LI_HORA')->textInput() ?>

    <?= $form->field($model, 'LI_FHIMPOR')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
