<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;

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
/* @var $form yii\widgets\ActiveForm */

DocumentoAsset::register($this);

?>

<div class="doclab-form">
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
                            <input id="edad" class="form-control" name="Estciv[ES_NOM]" value=<?= "'".$client->getEdad()."'" ?> readonly="true" maxlength="20" type="text">
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

          
         <!--    <hr> -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <label class="panel-title">
                <a data-toggle="collapse" href="#collapse-ocupacion" class="collapsed">Ocupación, Escolaridad, Nivel Ingresos</a>
            </label>
        </div>
        <div id="collapse-ocupacion" class="panel-collapse collapse">
            <br>
            <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_OCU', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Ocupa_1::getListaOcupa1(), ['id'=>'ocu-id','prompt' => 'Seleccione ocupación..']); ?>
 
                     </div>
            </div>
            <div class="row" >
                    <div class="col-md-6">
                    <?= $form->field($model, 'DO_RUBRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                        'options'=>['id'=>'subocu-id'],
                        'pluginOptions'=>[
                            'depends'=>['ocu-id'],
                            'placeholder'=>'Seleccione especifico...',
                            'url'=>Url::to(['/ocupa_2/subocu','id' => $model->DO_RUBRO]),
                            'loadingText' => '',
                            'initialize'=> true,
                        ]])->label(''); ?> 
 
                     </div>
            </div>
            <div class="row" >
                    <div class="col-md-6">
                    <?= $form->field($model, 'DO_RUBTIP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                            'pluginOptions'=>[
                                'depends'=>[ 'subocu-id'],
                                'placeholder'=>'Seleccione más especifico...',
                                    'url'=>Url::to(['/ocupa_3/subtip','id' => $model->DO_RUBTIP]),
                                    'loadingText' => '',
                                    'initialize'=> true,
                            ]
                    ])->label(''); ?> 
 
                     </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_ESCOL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Escolari::getListaEscolari(), ['prompt' => 'Seleccione escolaridad...']); ?>
 
                     </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_INGRES', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(NivelIn::getListaNiveles(), ['prompt' => 'Seleccione nivel ingresos...']); ?>
 
                     </div>
            </div>
        </div>
    </div>

    <!--    <hr> -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <label class="panel-title">
                <a data-toggle="collapse" href="#collapse-habitos" class="collapsed">Hábitos</a>
            </label>
        </div>
        <div id="collapse-habitos" class="panel-collapse collapse">
            <br>     
            <div class="row">
                    <div class="col-md-6">

                    <?= Html::activeHiddenInput($model, 'DO_FUMA') ?> 
                    <?= $form->field($model, 'fumador', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoFumador()), ['prompt' => 'Seleccione hábito fumador..','onchange'=>'javascript:mostrar_cuanto();']); ?>
 
                     </div>
                    <div class="col-md-6" id="campocuanto">
                       <?= $form->field($model, 'cuanto', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                                
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="campofase">
                   <?= $form->field($model, 'DO_FASTAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_fat::getListaFaseTab(), ['prompt' => 'Seleccione fase tabaquismo..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_ALCOH', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoAlcohol()), ['prompt' => 'Seleccione hábito alcohol..','onchange'=>'javascript:mostrar_cage();']); ?>
 
                     </div>
                </div>
                <div class="row">
                     <div class="col-md-12" id="campocage">
                   <?= $form->field($model, 'DO_CAGE', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->dropDownList(AlcCage::getListaCage(), ['prompt' => 'Seleccione..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_SEDAN', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoSedantes()), ['prompt' => 'Seleccione hábito sedantes..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_DEPOR', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoDeportes()), ['prompt' => 'Seleccione hábito deportes..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_SUENIO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoSueño()), ['prompt' => 'Seleccione hábito sueño..']); ?>
 
                     </div>
                </div>
            </div>
            </div>

          
         <!--    <hr> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">
                    <a data-toggle="collapse" href="#collapse-vacunacion" class="collapsed">Vacunación</a>
                </label>
            </div>
            <div id="collapse-vacunacion" class="panel-collapse collapse">
                <br>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_RUBEO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoRubeola()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_TETANO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoTetanos()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_ANTIGR', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoAntigripal()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_ANTIHE', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoAntihepatitis()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6">
                    <?= Html::activeHiddenInput($model, 'DO_VENER') ?> 
                   <?= $form->field($model, 'vener', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoVenereas()), ['prompt' => 'Seleccione ..','onchange'=>'javascript:mostrar_cual();'])->label('Venéreas'); ?>
 
                     </div>
                     <div class="col-md-6" id="campocual">
                        <?= $form->field($model, 'cual', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
 
                 </div>
                
            
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_TRANSF', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoTransfusiones()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
               
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_DOLLUM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoLumbar()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
             </div>
            </div>

          
         <!--    <hr> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">
                    <a data-toggle="collapse" href="#collapse-pato" class="collapsed">Patologías</a>
                </label>
            </div>
            <div id="collapse-pato" class="panel-collapse collapse">
                 <br>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_EAC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('01'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_HIPERT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('02'), ['id'=>'trat-id','onchange'=>'javascript:mostrar_trat();','prompt' => 'Seleccione ..']); ?>
 
                    </div>
                    <div class="col-md-6" id="campotrathi">
                       <!--  <?= $form->field($model, 'DO_TRATHI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                        'options'=>['id'=>'subtrat-id'],
                        'pluginOptions'=>[
                            'depends'=>['trat-id'],
                            'placeholder'=>'Seleccione tratamiento...',
                            'url'=>Url::to(['/pato_op2/subpato']),
                            'loadingText' => 'Cargando ...',
                        ]]) ?>  -->
                         <?= $form->field($model, 'DO_TRATHI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_op2::getListaPatologiaOpc2('04'), ['prompt' => 'Seleccione ..']); ?>
                        
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_COLEST', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('04'), ['id'=>'trat2-id','onchange'=>'javascript:mostrar_trat2();','prompt' => 'Seleccione ..']); ?>
                    </div>
                    <div class="col-md-6" id="campotrat2">
                        <!-- <?= $form->field($model, 'DO_TRATCO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                        'options'=>['id'=>'subtrat2-id'],
                        'pluginOptions'=>[
                            'depends'=>['trat2-id'],
                            'placeholder'=>'Seleccione tratamiento...',
                            'url'=>Url::to(['/pato_op2/subpato']),
                            'loadingText' => 'Cargando ...',
                        ]]) ?>  -->
                        <?= $form->field($model, 'DO_TRATCO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_op2::getListaPatologiaOpc2('10'), ['prompt' => 'Seleccione ..']); ?>
                        
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_DIABET', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('06'), ['id'=>'trat3-id','onchange'=>'javascript:mostrar_trat3();','prompt' => 'Seleccione ..']); ?>
 
                     </div>
                     <div class="col-md-6" id="campotrat3">
                       <!--  <?= $form->field($model, 'DO_TRATDI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                        'options'=>['id'=>'subtrat3-id'],
                        'pluginOptions'=>[
                            'depends'=>['trat3-id'],
                            'placeholder'=>'Seleccione tratamiento...',
                            'url'=>Url::to(['/pato_op2/subpato']),
                            'loadingText' => 'Cargando ...',
                        ]]) ?>  -->
                        <?= $form->field($model, 'DO_TRATDI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_op2::getListaPatologiaOpc2('16'), ['prompt' => 'Seleccione ..']); ?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_ANTQUI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('08'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_ONCO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('09'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <?php
                if ($client->CL_SEXO=='F')
                {
                ?>
                <div class="row">
                    <div class="col-md-6">
                         <?= Html::activeHiddenInput($model, 'DO_EMBARA') ?> 
                        <?= $form->field($model, 'emb', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('10'), ['prompt' => 'Seleccione ..','onchange'=>'javascript:mostrar_cuantosemb();']); ?>
 
                     </div>
                    <div class="col-md-6" id="campocuantosemb">
                        <?= $form->field($model, 'cuantosemb', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_ANOVU', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('11'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::activeHiddenInput($model, 'DO_MENOP') ?> 
                        <?= $form->field($model, 'menop', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('12'), ['prompt' => 'Seleccione ..','onchange'=>'javascript:mostrar_menop();']); ?>
 
                    </div>
                    <div class="col-md-6" id="campomenop">
                        <?= $form->field($model, 'edadmenop', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                </div>
                
                <?php 
                }
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_TRH', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('13'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_ASMAEP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('14'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                 <?php
                if ($client->CL_SEXO=='M')
                {
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_PROSTA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('15'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <?php 
                }
                ?>

            </div>
        </div>

          
         <!--    <hr> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">
                    <a data-toggle="collapse" href="#collapse-antecedentes" class="collapsed">Antecedentes Familiares Directos</a>
                </label>
            </div>
            <div id="collapse-antecedentes" class="panel-collapse collapse">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        
                        <?= $form->field($model, 'diabfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ['onchange'=>'javascript:mostrar_fam1();','prompt' => 'Seleccione ..']); ?>
 
                    </div>
                    <div class="col-md-6" id="campofam1">

                       <?= $form->field($model, 'DO_FADI',
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(Select2::classname(), [
                            'data' => Fami_opc::getListaFamOpc(),
                            
                          /*  'disabled' => !$filtro,*/
                            'options' => ['placeholder' => '','multiple' => true],
                            'pluginOptions' => [
                            'allowClear' => true
                            ],
                    ]);
                ?>               
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                        <?= $form->field($model, 'hiperfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ['onchange'=>'javascript:mostrar_fam2();','prompt' => 'Seleccione ..']); ?>
 
                    </div>
                    <div class="col-md-6" id="campofam2">
                        
                     <!--    <?= $form->field($model, 'hiperquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Fami_opc::getListaFamOpc(), ['multiple'=>'multiple']); ?>     -->   

                      <?= $form->field($model, 'DO_FAHIPE',
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(Select2::classname(), [
                            'data' => Fami_opc::getListaFamOpc(),
                            
                          /*  'disabled' => !$filtro,*/
                            'options' => ['placeholder' => '','multiple' => true],
                            'pluginOptions' => [
                            'allowClear' => true
                            ],
                    ]);
                ?>                         
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                        <?= $form->field($model, 'cardfam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ['onchange'=>'javascript:mostrar_fam3();','prompt' => 'Seleccione ..']); ?>
                    </div>
                    <div class="col-md-6" id="campofam3">
                        
                       <!--  <?= $form->field($model, 'cardquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Fami_opc::getListaFamOpc(), ['multiple'=>'multiple']); ?> -->

                        <?= $form->field($model, 'DO_FACARD',
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(Select2::classname(), [
                            'data' => Fami_opc::getListaFamOpc(),
                            
                          /*  'disabled' => !$filtro,*/
                            'options' => ['placeholder' => '','multiple' => true],
                            'pluginOptions' => [
                            'allowClear' => true
                            ],
                    ]);
                ?>            
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                     
                        <?= $form->field($model, 'oncofam', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList([ '01' => 'SI', '02' => 'NO'], ['onchange'=>'javascript:mostrar_fam4();','prompt' => 'Seleccione ..']); ?>
                    </div>
                    <div class="col-md-6" id="campofam4">
                        
                       <!--  <?= $form->field($model, 'oncoquienes', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Fami_opc::getListaFamOpc(), ['onchange'=>'javascript:mostrar_onco();','multiple'=>'multiple']); ?> -->
                       
                        <?= $form->field($model, 'DO_FAONCO',
                    ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(Select2::classname(), [
                            'data' => Fami_opc::getListaFamOpc(),
                            
                          /*  'disabled' => !$filtro,*/
                            'options' => ['placeholder' => '','multiple' => true],
                            'pluginOptions' => [
                            'allowClear' => true,
                            'onchange'=>'javascript:mostrar_onco();'
                            ],
                            
                    ]);
                ?>            
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6" id="campopadreonco">
                         <?= $form->field($model, 'DO_PAENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6" id="campomadreonco">
                         <?= $form->field($model, 'DO_MAENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6" id="campohermanoonco">
                         <?= $form->field($model, 'DO_HEENON', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])?>
                    </div>
                </div>
                <br>
            </div>
        </div>          
         <!--    <hr> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">
                    <a data-toggle="collapse" href="#collapse-examen" class="collapsed">Examen Físico</a>
                </label>
            </div>
            <div id="collapse-examen" class="panel-collapse collapse">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_NEVOS', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('01'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_NODMAN', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('02'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_SOPLOS', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Exfi_opc::getListaExfiOpc('03'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'DO_TUMAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Pato_opc::getListaPatologiaOpc('04'), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       <?= $form->field($model, 'DO_TALLA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true])?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_DATOS', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(['maxlength' => true])?>
                     </div>
                </div>

            </div>
        </div>

          
         <!--    <hr> -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">
                    <a data-toggle="collapse" href="#collapse-notas" class="collapsed">Notas</a>
                </label>
            </div>
            <div id="collapse-notas" class="panel-collapse collapse">
            <br>
                <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_DATINT', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(['maxlength' => true])?>
                     </div>
                </div>
            </div>
        </div>


        
        </div>
        </div>
    
     <div class="form-group im-centered">
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <?= Html::a('Historial Visitas' , ['doclabau/historial', 'id'=>$model->DO_NRO], ['class'=>'btn btn-info']);?>
            </div>
            <div class="col-md-3">
                <?= Html::a('Nueva Visita' , ['doclabau/create', 'id'=>$model->DO_NRO], ['class'=>'btn btn-primary']);?>
            </div>
            <div class="col-md-3">
            <!--     <?= Html::a('Guardar' , ['doclab/editar','id' => $model->DO_NRO], ['class'=>'btn btn-success']);?> -->
            <?= Html::submitButton('Guardar' , ['class' =>  'btn btn-success' ]) ?>
            </div>

        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>
