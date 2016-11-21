<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

use documento_salud\models\Clientes;
use documento_salud\models\TpoSer;
use documento_salud\models\Convenios;
use documento_salud\controllers\LibretasController;
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Libreta: '.$model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1>Libreta</h1>

   
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
                <div class="col-md-6">
                    <?= $form->field($cliente, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['readonly' => true,'maxlength' => true])?>
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
                <div class="col-md-2">
                     <?='<label class=" control-label" for="edad">Edad</label>' ?>
                </div>
                  
                <div class="col-md-2">
                    <?= Html::activeHiddenInput($cliente, 'edad') ?> 
                     <input type="text" class="form-control" id="edad" readonly="true" value = <?= "'".$cliente->getEdad()."'" ?>>
               
                </div>
                <div class="col-md-2">
                         <?='<label class=" control-label col-md-4" for="sexo">Sexo</label>' ?>
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

            <?= $form->field($cliente, 'CL_EMAIL')->textInput(['readonly' => true,'maxlength' => true]) ?>

            <br>
            <div class="row">
                <div class="col-md-2">
                    <?='<label class=" control-label" for="CL_IMG"> Foto </label>' ?>
                </div>
                <div class="col-md-2">
                    <?php 
                    if ($cliente->isNewRecord) { // echo $form->field($model, 'CL_IMG')->textInput(['maxlength' => true]);

                       
                      
                            echo "Cargar nueva  imagen";

                      
                    }
                    else {
                        $src = Yii::$app->params['path_clientes'].'/'.$cliente->CL_COD.'/'.$cliente->CL_IMG;
                        echo Html::img( $src, $options = ['title' => $cliente->CL_IMG,
                        'alt' => 'No se encontro la imágen', 'height'=>'200', 'width'=>'200'] );
                        }
                    ?>
                </div>
            </div>

        </div>
        </div>

        <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Libreta</h3>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model->lITPOSER, 'TS_DESC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label("Tipo Servicio") ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                        <?= $form->field($model->lICONVEN, 'CO_DESC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['readonly' => true,'maxlength' => true])->label("Convenio") ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_CONSULT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['0' => 'Pendiente','1' => 'Realizada'], ['itemOptions' => ['disabled' => true]])->label('Consulta médica'); ?> 
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_ESTUD', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['0' => 'Pendientes','1' => 'Realizados'], ['itemOptions' => ['disabled' => true]])->label('Estudios Laboratorio'); ?> 
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_IMPR', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['0' => 'Pendiente','1' => 'Realizada'], ['itemOptions' => ['disabled' => true]])->label('Impresión'); ?> 
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group field-libretas-li_fecret required">
                        <?= Html::activeHiddenInput($model, 'LI_FECRET') ?>
                        <label class="control-label col-md-4" for="libretas-li_fecret">Fecha Retiro</label>
                        <div class="col-md-4">
                            <?php if ($model->LI_FECIMP==null) { ?>
                                <input type="text" class="form-control" id="libretas-li_fecret" readonly="true" value = " " >
                             <?php   } 
                             else {
                                ?>
                                <input type="text" class="form-control" id="libretas-li_fecret" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->LI_FECRET, 'php:d-m-Y')."'" ?> />
                                <?php 
                                }
                                ?>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">

                    <?= $form->field($model, 'LI_IMPORTE', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                 </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group field-libretas-li_fecimp required">
                        <?= Html::activeHiddenInput($model, 'LI_FECIMP') ?>
                        <label class="control-label col-md-4" for="libretas-li_fecimp">Fecha Impresión </label>
                        <div class="col-md-4">
                            <?php if ($model->LI_FECIMP==null) { ?>
                                <input type="text" class="form-control" id="libretas-li_fecimp" readonly="true" value = " " >
                             <?php   } 
                             else {
                                ?>
                            <input type="text" class="form-control" id="libretas-li_fecimp" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->LI_FECIMP, 'php:d-m-Y')."'" ?> >
                            <?php 
                                }
                                ?>
                        </div>

                    </div>

                </div>
                <div class="col-md-4">

                        <?= $form->field($model, 'LI_COMP', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group field-libretas-li_fecvto required">
                        <?= Html::activeHiddenInput($model, 'LI_FECVTO') ?>
                        <label class="control-label col-md-4" for="libretas-li_fecvto">Fecha Vencimiento</label>
                        <div class="col-md-4">
                            <?php if ($model->LI_FECIMP==null) { ?>
                                <input type="text" class="form-control" id="libretas-li_fecvto" readonly="true" value = " " >
                             <?php   } 
                             else {
                                ?>
                            <input type="text" class="form-control" id="libretas-li_fecvto" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->LI_FECVTO, 'php:d-m-Y')."'" ?> >
                            <?php 
                                }
                                ?>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_ANULADA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['1' => 'Si','0' => 'No'], ['itemOptions' => ['disabled' => true]]) ?> 
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_ADIC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['1' => 'Si','0' => 'No'], ['itemOptions' => ['disabled' => true]])->label('¿Adicional?'); ?> 
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <?= $form->field($model, 'LI_IMPADI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                 </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'LI_REIMPR', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->inline()->radioList(['1' => 'Si','0' => 'No'], ['itemOptions' => ['disabled' => true]])->label('Reimpresión'); ?> 
                   
                </div>
            </div>



            

        </div>
        </div>

        

    <?php ActiveForm::end(); ?>

    <div class="form-group pull-right">
            
            <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
</div>
