<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;

use documento_salud\models\DocLab;
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
use documento_salud\assets\DocumentoAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclab */

DocumentoAsset::register($this);

?>

<div class="doclab-view">

<?php $form = ActiveForm::begin([   'id' => 'formDocLab', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
    <h4> Documento Salud Laboral</h4>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
     <table class="texto" style="width:100%" border="0">
        <tr >
            <td><b>N° Documento Laboral </b> <?= $model->DO_NRO ?></td>
        </tr>
        <tr>
            <td><b>Fecha Solic. </b><?= Yii::$app->formatter->asDate($lib->LI_FECPED, 'php:d-m-Y') ?></td>
            <td><b>Hora Solic. </b><?= $lib->LI_HORA ?></td>
            
        </tr>
    </table> 
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <table class="texto" style="width:100%" border="0">
        <tr>
            <td><b>Código Cliente </b> <?= $lib->LI_COCLI ?></td>
        </tr>
        <tr>
            <td><b>Apellido y Nombre </b> <?= $client->CL_APENOM ?></td>
        </tr>
        <tr>
            <td><b>Fecha de Nacimiento </b><?= Yii::$app->formatter->asDate($client->CL_FECNAC, 'php:d-m-Y') ?></td>
            <td><b>Edad </b> <?= $client->getEdad() ?></td>
        </tr>
        <tr>
            <td><b>Tipo Documento </b><?= $client->cLTIPDOC->TI_NOM ?></td>
            <td><b>N° Documento </b> <?= $client->CL_NUMDOC ?></td>
        </tr>
        <tr>
            <?php 
                if ($client->CL_SEXO=='M') {
                ?>
                    <td><b>Sexo </b>MASCULINO</td>
                <?php
                }
                else {
                    ?>
                     <td><b>Sexo </b>FEMENINO</td>
            <?php
            }
            ?>
             <td><b>Estado Civil </b><?= $client->cLESTCIV->ES_NOM ?></td>
        </tr>
        <tr>
            <td><b>Domicilio </b><?= $client->CL_DOMICI ?></td>
            <td><b>Localidad </b> <?= $client->cLCODLOC->LO_DETALLE ?></td>
        </tr>
        <tr>
            <td><b>Telefono </b><?= $client->CL_TEL ?></td>
        </tr>
        <tr>
            <td><b>Lugar de Trabajo </b><?= $client->CL_LUGTRA ?></td>
        </tr>

    </table>
     <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
     <table class="texto" style="width:100%" border="0">
        <tr>
            <td><b>Ocupación </b> <?= $model->dOOCU->TIPO ?> 
            <?php
                if ($model->DO_RUBRO) { ?>
                    - <?= $model->dORUBRO->TIPO ?> 
                    <?php
                    if ($model->DO_RUBTIP) { ?>
                        - <?= $model->dORUBTIP->TIPO ?></td>
                    <?php
                    }
                    else {
                        ?>
                        </td>
                    <?php
                    }
                    ?>
            <?
            }
            else {
                        ?>
                        </td>
                    <?php
                    }                   ?>
            ?>
            
        </tr>
         <tr>
            <td><b>Escolaridad </b><?= $model->dOESCOL->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Nivel Ingresos </b><?= $model->dOINGRES->NI_DETALLE ?></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Hábitos</h5>
     <table class="texto"  style="width:100%" border="0">
        <tr>
            <td><b>Fumador </b> <?= $model->fUMADOR->TIPO ?></td>
       
            <?php
            if ($model->fumador=="07") { ?> 
                <td><b>¿Cuántos Años? </b><?= $model->cuanto ?></td>
                   
            <?php 
            }
                ?>
        </tr>
        
            <?php 
                
            if (($model->fumador!="06")&&($model->DO_FASTAB)) {
                ?>
                <tr>
                    <td><b>Fase de Tabaquista </b> <?= $model->dOFASTAB->TIPO ?></td>
                </tr>
            
            <?php 
                }
               
            ?>
            <tr>
                <td><b>Alcohol </b><?= $model->dOALCOH->TIPO ?></td>
            </tr>
            <?php 
            if ($model->DO_CAGE) {
            ?>
                <tr>
                    <td><b>CAGE </b><?= $model->dOCAGE->TIPO ?></td>
                </tr>
                    
            <?php 
            }
               
            ?>
            <tr>
                <td><b>Sedantes </b><?= $model->dOSEDAN->TIPO ?></td>
            </tr>
            <tr>
                <td><b>Deportes </b><?= $model->dODEPOR->TIPO ?></td>
            </tr>
            <tr>
                <td><b>Trastornos del Sueño </b><?= $model->dOSUENIO->TIPO ?></td>
            </tr>
            
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Vacunación</h5>
     <table class="texto" style="width:100%" border="0">
        <tr>
            <td><b>Rubeóla </b> <?= $model->dORUBEO->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Tétanos </b><?= $model->dOTETANO->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Antigripal </b><?= $model->dOANTIGR->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Antihepatitis B </b><?= $model->dOANTIHE->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Enfermedades Venéreas </b><?= $model->vENER->TIPO ?></td>
            <?php                 
                        if ($model->cual) {
                        ?>
                        <td><b>¿Cuál? </b><?= $model->cual ?></td>
                         
                        <?php 
                        }
                       
                        ?>
        </tr>
        <tr>
            <td><b>Transfusiones </b><?= $model->dOTRANSF->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Dolor Lumbar (que ocasionó falta al trabajo) </b><?= $model->dODOLLUM->TIPO ?></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Patologías</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td><b>EAC </b> <?= $model->dOEAC->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Hipertensión </b><?= $model->dOHIPERT->TIPO ?></td>
            <?php                 
                        if ($model->DO_TRATHI) {
                        ?>
                        <td><b>Tratamiento </b><?= $model->dOTRATHI->TIPO ?></td>
                  
                    <?php 
                        }
        ?>
        </tr>
        <tr>
            <td><b>Colesterol </b><?= $model->dOCOLEST->TIPO ?></td>
            <?php                 
                        if ($model->DO_TRATCO) {
                        ?>
                        <td><b>Tratamiento </b><?= $model->dOTRATCO->TIPO ?></td>
            <?php 
                        }
            ?>
        </tr>
        <tr>
            <td><b>Diabetes </b><?= $model->dODIABET->TIPO ?></td>
            <?php                 
                        if ($model->DO_TRATDI) {
                        ?>
                        <td><b>Tratamiento </b><?= $model->dOTRATDI->TIPO ?></td>
                  
                    <?php 
                        }
                       
                        ?>
        </tr>
        <tr>
            <td><b>Antecedentes Quirúrgicos </b> <?= $model->dOANTQUI->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Oncológicos </b> <?= $model->dOONCO->TIPO ?></td>
        </tr>
        <?php
            if ($client->CL_SEXO=='F')
            {
            ?>
            <tr>
                <td><b>Embarazos </b> <?= $model->eMB->TIPO ?></td>
                <?php                 
                    if ($model->cuantosemb) {
                    ?>
                        <td><b>¿Cuántos? </b> <?= $model->cuantosemb ?></td>
                
                <?php 
                    }
                   
                    ?>
            </tr>
            <tr>
                <td><b>Anovulatorios </b> <?= $model->dOANOVU->TIPO ?></td>
                 
            </tr>
            <tr>
                <td><b>Menopausia </b> <?= $model->mENOP->TIPO ?></td>
                <?php                 
                    if ($model->edadmenop) {
                    ?>
                    <td><b>Edad </b> <?= $model->edadmenop ?></td>
                    
                <?php 
                    }
                   
                    ?>
            </tr>
            
            <?php 
            }
            ?>
        <tr>
            <td><b>TRH </b> <?= $model->dOTRH->TIPO ?></td>
        </tr>
        <tr>
            <td><b>Asma/Epoc </b> <?= $model->dOASMAEP->TIPO ?></td>
        </tr>

        <?php
        if ($client->CL_SEXO=='M')
        {
        ?>
        <tr>
            <td>
                 <b>  Prostatismo </b> <?= $model->dOPROSTA->TIPO  ?>


             </td>
        </tr>
        <?php 
        }
        ?>
       
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Antecedentes Familiares Directos</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td><b>Diabetes </b> <?= $model->diabfam ?>  </td>
            <?php
                if ($model->diabquienes!="") {
                ?>
                    <td><b>¿Quienes? </b> <?= $model->diabquienes ?>
                    </td>
                <?php  } ?>
        </tr>
        <tr>
            <td><b>Hipertensión </b> <?=  $model->hiperfam ?>  </td>
             <?php
                if ($model->hiperquienes!="")
                {  ?>
                    <td><b>¿Quienes? </b> <?=  $model->hiperquienes ?>
                    </td>
                    <?php }  ?>
        </tr>
        <tr>
            <td><b>Enfermedad Cardíaca </b> <?=  $model->cardfam ?>  </td>
             <?php
                if ($model->cardquienes!="")
                {  ?>
                    <td><b>¿Quienes? </b> <?=  $model->cardquienes ?>
                    </td>
                    <?php }  ?>
        </tr>
        <tr>
            <td><b>Oncológico </b> <?=  $model->oncofam ?>  </td>
             <?php
                if ($model->oncoquienes!="")
                {  ?>
                    <td><b>¿Quienes? </b> </td>
                        </tr>
                        <?php 
                            if (strpos($model->oncoquienes, 'Padre') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td><b>Padre </b><?=  $model->DO_PAENOM ?> </td>
                            </tr>
                        <?php } ?>
                        <?php 
                            if (strpos($model->oncoquienes, 'Madre') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td><b>Madre </b><?=  $model->DO_MAENOM ?> </td>
                            </tr>
                        <?php } ?>
                        <?php 
                            if (strpos($model->oncoquienes, 'Hermano') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td><b>Hermano </b><?=  $model->DO_HEENON ?> </td>
                            </tr>
                        <?php }
                    }
                        else{
                            ?>
                        </tr>
                        <?php   } ?>

                        


                   
        </tr>

    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Examen Físico</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td><b>Nevos </b> <?= DocLab::getExfiopc($model->DO_NEVOS); ?></td>
        </tr>
        <tr>
            <td><b>Nódulos de Mama </b> <?= DocLab::getExfiopc($model->DO_NODMAN); ?></td>
        </tr>
        <tr>
            <td><b>Soplos </b> <?= DocLab::getExfiopc($model->DO_SOPLOS); ?></td>
        </tr>
        <tr>
            <td><b>Tumor Abdominal </b> <?= DocLab::getPatoopc($model->DO_TUMAB); ?></td>
        </tr>
        <tr>
            <td><b>Talla (cm.) </b> <?= $model->DO_TALLA ?></td>
        </tr>
        <tr>
            <td><b>Otros Datos del Examen Físico</b> <?= $model->DO_DATOS ?></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>Otros Datos de Interés</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td><b>Notas </b> <?= $model->DO_DATINT ?></td>
        </tr>
    </table>
