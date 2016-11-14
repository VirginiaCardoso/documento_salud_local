<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);
?>

<div class="libretas-form">

    <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

   <div class="row">
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_FECPED', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
    </div>

    <hr />

    <h3>Cliente</h3>
    <div class="row">
        <div class="col-md-2 col-lg-1">
            <!-- Este botón abre un modal para buscar clientes -->
            <?= Html::button('Buscar', ['value' => Url::to(['clientes/index2']), 'title' => 'Buscar Cliente', 'class' => 'showModalButton btn btn-primary']); ?>
        </div>
        <div class="col-md-2">
            <?= Html::a('Nuevo Cliente', Url::toRoute(['clientes/create', 'origen' => 1]), ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-2 col-lg-offset-7 col-md-offset-6" <?= $model->LI_COCLI ? "" : "hidden";?>>
            <?= Html::a('Modificar Cliente', Url::toRoute(['clientes/update', 'CL_COD' => $model->LI_COCLI]), 
            ['class' => 'btn btn-warning btn-modificar-cliente']) ?>
        </div>
    </div>
    <br>
    <?php 
    if ($model->LI_COCLI) { ?>
        <?= $form->field($model, 'LI_COCLI')->textInput(['readonly' => true,'maxlength' => true]) ?>

       
        <?= $form->field($cliente, 'CL_APENOM')->textInput(['readonly' => true,'maxlength' => true]) ?>

        <div class="row">
            <div class="col-md-6">
     
               <?= $form->field($cliente->cLTIPDOC, 'TI_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
        <div class="col-md-4">

                    <?= $form->field($cliente, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
        </div>
    <?php 
    }
    ?>
    <hr />

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



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
