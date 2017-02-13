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

<div class="doclab-view2">

<?php $form = ActiveForm::begin([   'id' => 'formDocLab', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
    <div style="text-align: center;">
        <h4> Documento Salud Laboral</h4>
    </div>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
     <table class="texto" style="width:100%" border="0">
        <tr >
            <td>N° Documento Laboral <b> <?= $model->DO_NRO ?></b></td>
        </tr>
        <tr>
            <td>Fecha Solic. <b><?= Yii::$app->formatter->asDate($lib->LI_FECPED, 'php:d-m-Y') ?></b></td>
            <td>Hora Solic. <b><?= $lib->LI_HORA ?></b></td>
            
        </tr>
    </table> 
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <table class="texto" style="width:100%" border="0">
        <tr>
            <td>Código Cliente <b> <?= $lib->LI_COCLI ?></b></td>
        </tr>
        <tr>
            <td>Apellido y Nombre <b> <?= $client->CL_APENOM ?></b></td>
        </tr>
        <tr>
            <td>Fecha de Nacimiento <b><?= Yii::$app->formatter->asDate($client->CL_FECNAC, 'php:d-m-Y') ?></b></td>
            <td>Edad <b> <?= $client->getEdad() ?></b></td>
        </tr>
        <tr>
            <td>Tipo Documento <b><?= $client->cLTIPDOC->TI_NOM ?></b></td>
            <td>N° Documento <b> <?= $client->CL_NUMDOC ?></b></td>
        </tr>
        <tr>
            <?php 
                if ($client->CL_SEXO=='M') {
                ?>
                    <td>Sexo <b>MASCULINO</b></td>
                <?php
                }
                else {
                    ?>
                     <td>Sexo <b>FEMENINO</b></td>
            <?php
            }
            ?>
             <td>Estado Civil <b><?= $client->cLESTCIV->ES_NOM ?></b></td>
        </tr>
        <tr>
            <td>Domicilio <b><?= $client->CL_DOMICI ?></b></td>
            <td>Localidad <b> <?= $client->cLCODLOC->LO_DETALLE ?></b></td>
        </tr>
        <tr>
            <td>Telefono <b><?= $client->CL_TEL ?></b></td>
        </tr>
        <tr>
            <td>Lugar de Trabajo <b><?= $client->CL_LUGTRA ?></b></td>
        </tr>

    </table>
     <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
     <table class="texto" style="width:100%" border="0">
        <tr>
            <td>Ocupación <b> <?= $model->dOOCU->TIPO ?> </b>
            <?php
                if ($model->DO_RUBRO) { ?>
                    - <b><?= $model->dORUBRO->TIPO ?> 
                    <?php
                    if ($model->DO_RUBTIP) { ?>
                        - <b><?= $model->dORUBTIP->TIPO ?></b></td>
                    <?php
                    }
                    else {
                        ?>
                        </b></td>
                    <?php
                    }
                    ?>
            <?
            }
            else {
                        ?>
                        </b></td>
                    <?php
                    }                   ?>
            
            
        </tr>
         <tr>
            <td>Escolaridad <b><?= $model->dOESCOL->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Nivel Ingresos <b><?= $model->dOINGRES->NI_DETALLE ?></b></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>HÁBITOS</h5>
     <table class="texto"  style="width:100%" border="0">
        <tr>
            <td>Fumador <b> <?= $model->fUMADOR->TIPO ?></b></td>
       
            <?php
            if ($model->fumador=="07") { ?> 
                <td>¿Cuántos Años? <b><?= $model->cuanto ?></b></td>
                   
            <?php 
            }
                ?>
        </tr>
        
            <?php 
                
            if (($model->fumador!="06")&&($model->DO_FASTAB)) {
                ?>
                <tr>
                    <td>Fase de Tabaquista <b> <?= $model->dOFASTAB->TIPO ?></b></td>
                </tr>
            
            <?php 
                }
               
            ?>
            <tr>
                <td>Alcohol <b><?= $model->dOALCOH->TIPO ?></b></td>
            </tr>
            <?php 
            if ($model->DO_CAGE) {
            ?>
                <tr>
                    <td>CAGE <b><?= $model->dOCAGE->TIPO ?></b></td>
                </tr>
                    
            <?php 
            }
               
            ?>
            <tr>
                <td>Sedantes <b><?= $model->dOSEDAN->TIPO ?></b></td>
            </tr>
            <tr>
                <td>Deportes <b><?= $model->dODEPOR->TIPO ?></b></td>
            </tr>
            <tr>
                <td>Trastornos del Sueño <b><?= $model->dOSUENIO->TIPO ?></b></td>
            </tr>
            
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>VACUNACIÓN</h5>
     <table class="texto" style="width:100%" border="0">
        <tr>
            <td>Rubeóla <b> <?= $model->dORUBEO->TIPO ?></td>
        </tr>
        <tr>
            <td>Tétanos <b><?= $model->dOTETANO->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Antigripal <b><?= $model->dOANTIGR->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Antihepatitis B <b><?= $model->dOANTIHE->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Enfermedades Venéreas <b><?= $model->vENER->TIPO ?></b></td>
            <?php                 
                        if ($model->cual) {
                        ?>
                        <td>¿Cuál? <b><?= $model->cual ?></b></td>
                         
                        <?php 
                        }
                       
                        ?>
        </tr>
        <tr>
            <td>Transfusiones <b><?= $model->dOTRANSF->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Dolor Lumbar (que ocasionó falta al trabajo) <b><?= $model->dODOLLUM->TIPO ?></b></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>PATOLOGÍAS</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td>EAC <b> <?= $model->dOEAC->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Hipertensión <b><?= $model->dOHIPERT->TIPO ?></b></td>
            <?php                 
                        if ($model->DO_TRATHI) {
                        ?>
                        <td>Tratamiento <b><?= $model->dOTRATHI->TIPO ?></b></td>
                  
                    <?php 
                        }
        ?>
        </tr>
        <tr>
            <td>Colesterol <b><?= $model->dOCOLEST->TIPO ?></td>
            <?php                 
                        if ($model->DO_TRATCO) {
                        ?>
                        <td>Tratamiento <b><?= $model->dOTRATCO->TIPO ?></b></td>
            <?php 
                        }
            ?>
        </tr>
        <tr>
            <td>Diabetes <b><?= $model->dODIABET->TIPO ?></td>
            <?php                 
                        if ($model->DO_TRATDI) {
                        ?>
                        <td>Tratamiento <b><?= $model->dOTRATDI->TIPO ?></b></td>
                  
                    <?php 
                        }
                       
                        ?>
        </tr>
        <tr>
            <td>Antecedentes Quirúrgicos <b> <?= $model->dOANTQUI->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Oncológicos <b> <?= $model->dOONCO->TIPO ?></b></td>
        </tr>
        <?php
            if ($client->CL_SEXO=='F')
            {
            ?>
            <tr>
                <td>Embarazos <b> <?= $model->eMB->TIPO ?></td>
                <?php                 
                    if ($model->cuantosemb) {
                    ?>
                        <td>¿Cuántos? <b> <?= $model->cuantosemb ?></b></td>
                
                <?php 
                    }
                   
                    ?>
            </tr>
            <tr>
                <td>Anovulatorios <b> <?= $model->dOANOVU->TIPO ?></b></td>
                 
            </tr>
            <tr>
                <td>Menopausia <b> <?= $model->mENOP->TIPO ?></b></td>
                <?php                 
                    if ($model->edadmenop) {
                    ?>
                    <td>Edad <b> <?= $model->edadmenop ?></b></td>
                    
                <?php 
                    }
                   
                    ?>
            </tr>
            
            <?php 
            }
            ?>
        <tr>
            <td>TRH <b> <?= $model->dOTRH->TIPO ?></b></td>
        </tr>
        <tr>
            <td>Asma/Epoc <b> <?= $model->dOASMAEP->TIPO ?></b></td>
        </tr>

        <?php
        if ($client->CL_SEXO=='M')
        {
        ?>
        <tr>
            <td>
                   Prostatismo <b> <?= $model->dOPROSTA->TIPO  ?></b>


             </td>
        </tr>
        <?php 
        }
        ?>
       
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>ANTECEDENTES FAMILIARES DIRECTOS</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td>Diabetes <b> <?= $model->diabfam ?> </b> </td>
            <?php
                if ($model->diabquienes!="") {
                ?>
                    <td>¿Quienes? <b> <?= $model->diabquienes ?></b>
                    </td>
                <?php  } ?>
        </tr>
        <tr>
            <td>Hipertensión <b> <?=  $model->hiperfam ?> </b> </td>
             <?php
                if ($model->hiperquienes!="")
                {  ?>
                    <td>¿Quienes? <b> <?=  $model->hiperquienes ?></b>
                    </td>
                    <?php }  ?>
        </tr>
        <tr>
            <td>Enfermedad Cardíaca <b> <?=  $model->cardfam ?> </b> </td>
             <?php
                if ($model->cardquienes!="")
                {  ?>
                    <td>¿Quienes? <b> <?=  $model->cardquienes ?>
                    </b></td>
                    <?php }  ?>
        </tr>
        <tr>
            <td>Oncológico <b> <?=  $model->oncofam ?>  </td>
             <?php
                if ($model->oncoquienes!="")
                {  ?>
                    <td>¿Quienes?  </td>
                        </tr>
                        <?php 
                            if (strpos($model->oncoquienes, 'Padre') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td>Padre <b><?=  $model->DO_PAENOM ?> </b></td>
                            </tr>
                        <?php } ?>
                        <?php 
                            if (strpos($model->oncoquienes, 'Madre') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td>Madre <b><?=  $model->DO_MAENOM ?></b> </td>
                            </tr>
                        <?php } ?>
                        <?php 
                            if (strpos($model->oncoquienes, 'Hermano') !== false) { ?>
                            <tr>
                                <td> </td>
                                <td>Hermano <b><?=  $model->DO_HEENON ?> </b></td>
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
    <h5>EXAMEN FÍSICO</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td>Nevos <b> <?= DocLab::getExfiopc($model->DO_NEVOS); ?></b></td>
        </tr>
        <tr>
            <td>Nódulos de Mama <b> <?= DocLab::getExfiopc($model->DO_NODMAN); ?></b></td>
        </tr>
        <tr>
            <td>Soplos <b> <?= DocLab::getExfiopc($model->DO_SOPLOS); ?></b></td>
        </tr>
        <tr>
            <td>Tumor Abdominal <b> <?= DocLab::getPatoopc($model->DO_TUMAB); ?></b></td>
        </tr>
        <tr>
            <td>Talla (cm.) <b> <?= $model->DO_TALLA ?></b></td>
        </tr>
        <tr>
            <td>Otros Datos del Examen Físico<b> <?= $model->DO_DATOS ?></b></td>
        </tr>
    </table>
    <hr style='margin-top:0.5em;  margin-bottom:0.5em'>
    <h5>OTROS DATOS DE INTERÉS</h5>
    <table class="texto"  style="width:100%" border="0">
        <tr>
            <td>Notas <b> <?= $model->DO_DATINT ?></b></td>
        </tr>
    </table>
       

            
<?php ActiveForm::end(); ?>            
    </div>