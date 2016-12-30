<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doclab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DO_CODCLI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_OCU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_RUBRO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_RUBTIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ESCOL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_INGRES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FUMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FASTAB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ALCOH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_CAGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_SEDAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_DEPOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_SUENIO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_EAC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_HIPERT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TRATHI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_COLEST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TRATCO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_DIABET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TRATDI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ANTQUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ONCO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_EMBARA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ANOVU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_MENOP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TRH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ASMAEP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_PROSTA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_RUBEO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TETANO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ANTIGR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_ANTIHE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TRANSF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_VENER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_DOLLUM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FADI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FAHIPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FACARD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_FAONCO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_PAENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_MAENOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_HEENON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_NEVOS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_NODMAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_SOPLOS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TUMAB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_TALLA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_DATOS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DO_DATINT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
