<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libretas-form">

    <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

   <div class="row">
    <div class="col-md-6"> 
            <?= $form->field($model, 'LI_FECPED', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
        <div class="col-md-6"> 
            <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
    </div>

  
 <!--   <?= $form->field($model, 'LI_COCLI')->textInput(['maxlength' => true]) ?>-->

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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
