<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpo-ser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TS_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TS_DESC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TS_IMP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TS_CLASE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Volver',['index'],array('class'=>'btn btn-danger'));?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
