<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clases */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clases-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CL_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CL_DESC')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Volver',['index'],array('class'=>'btn btn-danger'));?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
