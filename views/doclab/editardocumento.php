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
use documento_salud\controllers\LibretasController;
use documento_salud\assets\DocumentoAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

DocumentoAsset::register($this);

$this->title = 'Editar Documento Laboral: '.$model->DO_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Documento Salud Laboral', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1> Documento Salud Laboral</h1>

   
     <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
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

          
            <hr>

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
                            'url'=>Url::to(['/ocupa_2/subocu']),
                            'loadingText' => 'Cargando ...',
                        ]])->label(''); ?> 
 
                     </div>
            </div>
            <div class="row" >
                    <div class="col-md-6">
                    <?= $form->field($model, 'DO_RUBTIP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DepDrop::classname(), [
                            'pluginOptions'=>[
                                'depends'=>[ 'subocu-id'],
                                'placeholder'=>'Seleccione más especifico...',
                                    'url'=>Url::to(['/ocupa_3/subtip']),
                                    'loadingText' => 'Cargando ...',
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
    

        
        <hr>
        
        <h3>Hábitos</h3>
                
            <div class="row">
                    <div class="col-md-6">

                    <?= Html::activeHiddenInput($model, 'DO_FUMA') ?> 
                    <?= $form->field($model, 'fumador', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoFumador()), ['prompt' => 'Seleccione hábito fumador..','onchange'=>'javascript:mostrar_cuanto();']); ?>
 
                     </div>
                     <div class="col-md-4" id="campocuanto">
                        <?= $form->field($model, 'cuanto')->textInput(['maxlength' => true])->label(Habi_opc::labelEx()) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_FASTAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_fat::getListaFaseTab(), ['prompt' => 'Seleccione fase tabaquismo..']); ?>
 
                     </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_ALCOH', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Habi_opc::getListaHabitoOpc(Habitos::codigoAlcohol()), ['prompt' => 'Seleccione hábito alcohol..']); ?>
 
                     </div>
                     <div class="col-md-4">
                   <?= $form->field($model, 'DO_CAGE', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6']])->dropDownList(AlcCage::getListaCage(), ['prompt' => 'Seleccione..']); ?>
 
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
            <hr>
            <h3>Vacunación</h3>
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
                <br>
                 <div class="row">
                    <div class="col-md-6">
                    <?= Html::activeHiddenInput($model, 'DO_VENER') ?> 
                   <?= $form->field($model, 'vener', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoVenereas()), ['prompt' => 'Seleccione ..','onchange'=>'javascript:mostrar_cual();'])->label('Venéreas'); ?>
 
                     </div>
                     <div class="col-md-4" id="campocual">
                        <?= $form->field($model, 'cual')->textInput(['maxlength' => true])->label(Vacu_opc::labelVen()) ?>
                    </div>
 
                 </div>
                
                <br>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_TRANSF', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoTransfusiones()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-6">
                   <?= $form->field($model, 'DO_DOLLUM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList(Vacu_opc::getListaVacuOpc(Vacunaci::codigoLumbar()), ['prompt' => 'Seleccione ..']); ?>
 
                     </div>
                </div>
                
               
            <hr>
            <h3 >Patologías</h3>
            <hr>
            <h3 >Antecedentes Familiares Directos</h3>
            <hr>
            <h3 >Examen Físico</h3>
            
            <hr>
            <h3 >Notas</h3>
        
        </div>
        </div>
    <?php ActiveForm::end(); ?>
     <div class="form-group im-centered">
        <div class="row ">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <?= Html::a('Historial Visitas' , ['libretas/index'], ['class'=>'btn btn-info']);?>
            </div>
            <div class="col-md-3">
                <?= Html::a('Nueva Visita' , ['libretas/index'], ['class'=>'btn btn-primary']);?>
            </div>
            <div class="col-md-3">
                <?= Html::a('Guardar' , ['libretas/index'], ['class'=>'btn btn-success']);?>
            </div>

        </div>


       

            
            
    </div>
</div>
