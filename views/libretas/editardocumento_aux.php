<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

use documento_salud\models\Clientes;
use documento_salud\models\Ocupa_1;
use documento_salud\models\Convenios;
use documento_salud\controllers\LibretasController;
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Editar Documento Laboral: '.$model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1>Editar Documento Laboral</h1>

   
     <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                    <div class="form-group field-libretas-li_fecped required">
                        <?= Html::activeHiddenInput($model, 'LI_FECPED') ?>
                        <label class="control-label col-md-4" for="libretas-li_fecped">Fecha Solic.</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="libretas-li_fecped" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->LI_FECPED, 'php:d-m-Y')."'" ?> >
                        </div>

                    </div>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Hora Solic.") ?>
            </div>
        </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Cliente</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                   <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label("Código Cliente")?>
                </div>
               
                
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($cliente->cLTIPDOC, 'TI_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
                <div class="col-md-4">

                        <?= $form->field($cliente, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                
                 <div class="col-md-6">
                    <?= $form->field($cliente, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['readonly' => true,'maxlength' => true])?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                        <?= $form->field($cliente, 'CL_FECNAC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group field-edad">
                        <label class="control-label col-md-4" for="edad">Edad</label>
                        <div class="col-md-6">
                            <?= Html::activeHiddenInput($cliente, 'edad') ?>
                            <input id="edad" class="form-control" name="Estciv[ES_NOM]" value=<?= "'".$cliente->getEdad()."'" ?> readonly="true" maxlength="20" type="text">
                        <div class="help-block help-block-error "></div>
                    </div>
                </div>

                </div>
                </div>
            <div class="row">
                <div class="col-md-2">
                         <?='<label class=" control-label " for="sexo">Sexo</label>' ?>
                    </div>
                  
                    <div class="col-md-2">
                            <?php 
                            if ($cliente->CL_SEXO=='M') {
                            ?>
                                <input type="text" class="form-control" id="sexo" readonly="true" value = "Masculino">
                            <?php
                            }
                            else {
                                ?>
                                <input type="text" class="form-control" id="sexo" readonly="true" value = "Femenino">
                            <?php
                            }
                            ?>
                    </div>
                <div class="col-md-4">

                        <?= $form->field($cliente->cLESTCIV, 'ES_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($cliente, 'CL_DOMICI')->textInput(['readonly' => true,'maxlength' => true]) ?>

            <?= $form->field($cliente->cLCODLOC, 'LO_DETALLE', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])->textInput(['readonly' => true,'maxlength' => true]) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($cliente, 'CL_TEL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($cliente, 'CL_LUGTRA')->textInput(['readonly' => true,'maxlength' => true]) ?>

          
            <hr>

            <div class="row">
                    <div class="col-md-6">
 
                        <?= $form->field($model, 'DO_OCU', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList( Ocupa_1::getListaOcupa1(), ['prompt' => 'Seleccione una ocupación..', 'onchange'=>'javascript:seleccionoOcupa1();']); ?>
                     </div>
                </div>

        </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Información Libreta</h3>
            </div>
            <div class="panel-body">




            

            </div>
        </div>

        

    <?php ActiveForm::end(); ?>

    <div class="form-group pull-right">
            
            <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
</div>
