<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\DiasNoLaborables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dias-no-laborables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DI_FEC')->widget(DateControl::classname(), [
            'type'=>DateControl::FORMAT_DATE,

            'ajaxConversion'=>false,
            'options' => [
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]);
    ?>

    <?= $form->field($model, 'DI_DESCRI')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
         <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Volver', ['index'], ['class'=>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
