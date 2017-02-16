<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use documento_salud\models\Clientes;
use documento_salud\models\Ocupa_1;
use documento_salud\models\Ocupa_2;
use documento_salud\models\Ocupa_3;
use documento_salud\models\Convenios;
use documento_salud\models\Escolari;
use documento_salud\models\NivelIn;
use documento_salud\models\Habitos;
use documento_salud\models\Habi_opc;
use documento_salud\models\Habi_fat;
use documento_salud\models\AlcCage;
use documento_salud\models\Vacunaci;
use documento_salud\models\Vacu_opc;
use documento_salud\models\Pato_opc;
use documento_salud\models\Pato_op2;
use documento_salud\models\Fami_opc;
use documento_salud\models\Exfi_opc;
use documento_salud\controllers\LibretasController;
use documento_salud\assets\VerDocumentoAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */

VerDocumentoAsset::register($this);

$this->title =  'Ver Documento Laboral: '.$model->DO_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Consulta Médica', 'url' => ['/libretas/consulta-medica/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclab-view">


 <h1> Documento Salud Laboral</h1>

   
     <?php $form = ActiveForm::begin([   'id' => 'formDocLab', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($model, 'DO_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                    <div class="form-group field-libretas-li_fecped required">
                        <?= Html::activeHiddenInput($lib, 'LI_FECPED') ?>
                        <label class="control-label col-md-4" for="libretas-li_fecped">Fecha Solic.</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="libretas-li_fecped" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($lib->LI_FECPED, 'php:d-m-Y')."'" ?> >
                        </div>

                    </div>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($lib, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Hora Solic.") ?>
            </div>
        </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Cliente</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                   <?= $form->field($lib, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label("Código Cliente")?>
                </div>
               
                
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($client->cLTIPDOC, 'TI_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
                <div class="col-md-4">

                        <?= $form->field($client, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                
                 <div class="col-md-6">
                    <?= $form->field($client, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['readonly' => true,'maxlength' => true])?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">

                        <?= $form->field($client, 'CL_FECNAC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true, 'value' => Yii::$app->formatter->asDate($client->CL_FECNAC, 'php:d-m-Y')]) ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group field-edad">
                        <label class="control-label col-md-4" for="edad">Edad</label>
                        <div class="col-md-6">
                            <?= Html::activeHiddenInput($client, 'edad') ?>
                            <input id="edad" class="form-control" name="Edad[ES_NOM]" value=<?= "'".$client->getEdad()."'" ?> readonly="true" maxlength="20" type="text">
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
                            if ($client->CL_SEXO=='M') {
                            ?>
                                <input type="text" class="form-control" id="sexo" readonly="true" value = "MASCULINO">
                            <?php
                            }
                            else {
                                ?>
                                <input type="text" class="form-control" id="sexo" readonly="true" value = "FEMENINO">
                            <?php
                            }
                            ?>
                    </div>
                <div class="col-md-4">

                        <?= $form->field($client->cLESTCIV, 'ES_NOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($client, 'CL_DOMICI')->textInput(['readonly' => true,'maxlength' => true]) ?>

            <?= $form->field($client->cLCODLOC, 'LO_DETALLE', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])->textInput(['readonly' => true,'maxlength' => true]) ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($client, 'CL_TEL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($client, 'CL_LUGTRA')->textInput(['readonly' => true,'maxlength' => true]) ?>

          
    
        </div>
    </div>  
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Ocupación, Escolaridad, Nivel Ingresos</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="col-md-6">
                   
                        <?= $form->field($model->dOOCU, 'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Ocupación') ?>
                    </div>
            </div>
            <?php
                if ($model->DO_RUBRO) { ?>
                <div class="row" >
                        <div class="col-md-6">

                        <?= $form->field($model->dORUBRO, 'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('') ?>
     
                         </div>
                </div>
                <?php
                if ($model->DO_RUBTIP) { ?>
                    <div class="row" >
                            <div class="col-md-6">
                            <?= $form->field($model->dORUBTIP, 'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('') ?>
         
                             </div>
                    </div>
            <?php 
                }
            }
            ?>
            <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOESCOL, 'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Escolaridad') ?>
 
                     </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOINGRES, 'NI_DETALLE', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Nivel Ingresos') ?>
 
                     </div>
            </div>
        </div>
    </div>

      
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Hábitos</h3>
        </div>
        <div class="panel-body">    
            <div class="row">
                    <div class="col-md-6">

                    <?= $form->field($model->fUMADOR,'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Fumador') ?>
 
                     </div>
                    <?php
                if ($model->fumador=="07") { ?> 
                    <div class="col-md-6" id="campocuanto">
                       <?= $form->field($model, 'cuanto', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])?>
                                
                    </div>
                <?php 
                }
                
                ?>
            </div>
            <?php 
                
                 if (($model->fumador!="06")&&($model->DO_FASTAB)) {
                ?>
            <div class="row">
                <div class="col-md-6">
               <?= $form->field($model->dOFASTAB, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Fase de Tabaquista') ?>

                 </div>
            </div>
            <?php 
                }
               
                ?>
                <div class="row">
                    <div class="col-md-6">
                    <?= $form->field($model->dOALCOH, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Alcohol') ?>
                  
 
                     </div>
                     <?php 
                
                        if ($model->DO_CAGE) {
                        ?>
                     <div class="col-md-6">
                   <?= $form->field($model->dOCAGE,'TIPO',['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])->textInput(['readonly' => true,'maxlength' => true])->label('CAGE') ?>
 
                     </div>
                     <?php 
                }
               
                ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOSEDAN, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Sedantes') ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dODEPOR, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Deportes') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOSUENIO, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Trastornos del Sueño') ?>  
                    </div>
                </div>
            </div>
            </div>

            
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Vacunación</h3>
        </div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                     <?= $form->field($model->dORUBEO, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Rubeóla') ?> 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                  <?= $form->field($model->dOTETANO, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Tétanos') ?> 
 
                     </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model->dOANTIGR, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Antigripal') ?> 
 
                     </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model->dOANTIHE, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Antihepatitis B') ?> 
                     </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->vENER,'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Venéreas') ?>
 
                    </div>
                      <?php                 
                        if ($model->cual) {
                        ?>
                             <div class="col-md-6" id="campocual">
                                <?= $form->field($model, 'cual', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])?>
                            </div>
                        <?php 
                        }
                       
                        ?>
                 </div>
                
                <br>
                 <div class="row">
                    <div class="col-md-6">
                    <?= $form->field($model->dOTRANSF, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Transfusiones') ?>
 
                     </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dODOLLUM, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Dolor Lumbar (que ocasionó falta al trabajo)') ?>
 
                     </div>
                </div>
             </div>
            </div>

           
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Patologías</h3>
        </div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOEAC, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('EAC') ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOHIPERT, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Hipertensión') ?>
 
                    </div>
                    <?php                 
                        if ($model->DO_TRATHI) {
                        ?>
                    <div class="col-md-6" id="campotrathi">
                         <?= $form->field($model->dOTRATHI, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Tratamiento') ?>
                        
                    </div>
                    <?php 
                        }
                       
                        ?>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOCOLEST, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Colesterol') ?>
 
                    </div>
                    <?php                 
                        if ($model->DO_TRATCO) {
                        ?>
                    <div class="col-md-6" id="campotrat2">
                         <?= $form->field($model->dOTRATCO, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Tratamiento') ?>
                        
                    </div>
                    <?php 
                        }
                       
                        ?>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dODIABET, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Diabetes') ?>
 
                    </div>
                    <?php                 
                        if ($model->DO_TRATDI) {
                        ?>
                    <div class="col-md-6" id="campotrat3">
                         <?= $form->field($model->dOTRATDI, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Tratamiento') ?>
                        
                    </div>
                    <?php 
                        }
                       
                        ?>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOANTQUI, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Antecedentes Quirúrgicos') ?>
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOONCO, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Oncológicos') ?>
 
                     </div>
                </div>
                <?php
                if ($client->CL_SEXO=='F')
                {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        
                        <?= $form->field($model->eMB,'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Embarazos') ?>
 
                    </div>
                      <?php                 
                        if ($model->cuantosemb) {
                        ?>
                    <div class="col-md-6" id="campocuantosemb">
                        <?= $form->field($model, 'cuantosemb', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])?>
                    </div>
                    <?php 
                        }
                       
                        ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model->dOANOVU, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Anovulatorios') ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         
                        <?= $form->field($model->mENOP,'TIPO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Menopausia') ?>
 
                    </div>
                      <?php                 
                        if ($model->edadmenop) {
                        ?>
                    <div class="col-md-6" id="campomenop">
                        <?= $form->field($model, 'edadmenop', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                    <?php 
                        }
                       
                        ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOTRH, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('TRH') ?>
 
                     </div>
                </div>
                <?php 
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOASMAEP, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Asma/Epoc') ?>
 
                     </div>
                </div>
                 <?php
                if ($client->CL_SEXO=='M')
                {
                ?>
                <div class="row">
                    <div class="col-md-6">
                         <?= $form->field($model->dOPROSTA, 'TIPO',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('Prostatismo') ?>
 
 
                     </div>
                </div>
                <?php 
                }
                ?>

            </div>
        </div>
 
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Antecedentes Familiares Directos</h3>
        </div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                         
                        <?= $form->field($model, 'diabfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ["disabled"=>"disabled",'onchange'=>'javascript:mostrar_fam1();','prompt' => 'Seleccione ..']); ?>
 
                    </div>
                    <?php
                if ($model->diabquienes!="")
                {
                ?>
                    <div class="col-md-6" id="campofam1">
                     
                        <?= $form->field($model, 'diabquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])?>                    
                    </div>
                    <?php 
                }
                ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       
                        <?= $form->field($model, 'hiperfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ["disabled"=>"disabled",'onchange'=>'javascript:mostrar_fam2();','prompt' => 'Seleccione ..']); ?>
 
                    </div>
                    <?php
                if ($model->hiperquienes!="")
                {
                ?>
                    <div class="col-md-6" id="campofam2">
                        
                        <?= $form->field($model, 'hiperquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])?>                              
                    </div>
                <?php 
                }
                ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       
                        <?= $form->field($model, 'cardfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ["disabled"=>"disabled",'onchange'=>'javascript:mostrar_fam3();','prompt' => 'Seleccione ..']); ?>
                    </div>
                    <?php
                if ($model->cardquienes!="")
                {
                ?>
                    <div class="col-md-6" id="campofam3">
                        
                        <?= $form->field($model, 'cardquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])?>          
                    </div>
                 <?php 
                }
                ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                        <?= $form->field($model, 'oncofam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ["disabled"=>"disabled",'onchange'=>'javascript:mostrar_fam4();','prompt' => 'Seleccione ..']); ?>
                    </div>
                     <?php
                if ($model->oncoquienes!="")
                {
                ?>
                    <div class="col-md-6" id="campofam4">
                        
                        <?= $form->field($model, 'oncoquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])?>          
                    </div>
                <?php 
                }
                ?>
                </div>
                 <?php 
                
                 if ($model->oncofam=="01") {
                ?>
                    <?php 
                
                     if ($model->DO_PAENOM!="") {
                    ?>
                        <div class="row ">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6" id="campopadreonco">
                                 <?= $form->field($model, 'DO_PAENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(["disabled"=>"disabled",'maxlength' => true])?>
                            </div>
                        </div>
                    <?php 
                    }
                    if ($model->DO_MAENOM!="") {
                    ?>
                        <div class="row ">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6" id="campomadreonco">
                                 <?= $form->field($model, 'DO_MAENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(["disabled"=>"disabled",'maxlength' => true])?>
                            </div>
                        </div>
                    <?php 
                    }
                    if ($model->DO_HEENON!="") {
                    ?>
                    <div class="row ">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6" id="campohermanoonco">
                             <?= $form->field($model, 'DO_HEENON', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(["disabled"=>"disabled",'maxlength' => true])?>
                        </div>
                    </div>
                <?php 
                    }
                }
                ?>
                <br>
            </div>
        </div>          
          
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Examen Físico</h3>
        </div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_NEVOS', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('01'), ["disabled"=>"disabled",'prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_NODMAN', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('02'), ["disabled"=>"disabled",'prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_SOPLOS', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('03'), ["disabled"=>"disabled",'prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_TUMAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('04'), ["disabled"=>"disabled",'prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       <?= $form->field($model, 'DO_TALLA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(["disabled"=>"disabled",'maxlength' => true])?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_DATOS', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(["disabled"=>"disabled",'maxlength' => true])?>
                     </div>
                </div>

            </div>
        </div>

          
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Otros Datos de Interés</h3>
        </div>
        <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_DATINT', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(["disabled"=>"disabled",'maxlength' => true])?>
                     </div>
                </div>
            </div>
    </div>


        
    </div>
    <?php
        $filename = "reporte_".$lib->LI_COCLI.".pdf";
        $filepath =  Yii::$app->params['path_clientes'].$lib->LI_COCLI.'/reporte/'.$filename; 
    ?>
    <div class="form-group im-centered">
        <div class="row ">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir' ,  ['report', 'codcli' => $lib->LI_COCLI], [
             'class'=>'btn btn-info',
             'id' => 'btn_imprimir',
             'target'=> '_blank',
             'data-toggle'=>'tooltip',
             'title'=> 'Imprimir']);?>

               
            </div>
            <div class="col-md-4">
                <?= Html::a('Volver' , ['libretas/consulta-medica'], ['class'=>'btn btn-primary']);?>
            </div>
            

        </div>
</div>
</div>

    

            
<?php ActiveForm::end(); ?>            
   
</div>
