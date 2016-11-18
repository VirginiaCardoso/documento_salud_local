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
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);

Pjax::begin(); 
?>

<div class="libretas-form">

    <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

   <div class="row">
         <div class="col-md-1">
                 <?='<label class=" control-label col-md-4" for="fecha">Fecha</label>' ?>
            </div>
            <div class="col-md-2">
                <?= Html::activeHiddenInput($model, 'LI_FECPED') ?> 
                 <input type="text" class="form-control" id="fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->LI_FECPED, 'php:d-m-Y')."'" ?>>
            </div>
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
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
            <?= Html::a('Modificar Cliente', Url::toRoute(['clientes/update2', 'CL_COD' => $model->LI_COCLI]), 
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
        <div class="row">
            <div class="col-md-2">
                 <?='<label class=" control-label" for="edad">Edad</label>' ?>
            </div>
              
            <div class="col-md-2">
                <?= Html::activeHiddenInput($cliente, 'edad') ?> 
                 <input type="text" class="form-control" id="edad" readonly="true" value = <?= "'".$cliente->getEdad()."'" ?>>
           
            </div>
            <div class="col-md-2">
                     <?='<label class=" control-label" for="sexo">Sexo</label>' ?>
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

                    <?= $form->field($cliente->cLESTCIV, 'ES_NOM', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
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

    
    <hr />

    <!--  campos nuevo tramite -->
    <?php 
        $tramiteproceso = LibretasController::findtramiteProceso($cliente->CL_COD);

    if ($tramiteproceso!=null) {
        
        ?>
        <div class="row">
            <div class="col-md-12 ">
                <label class='label_proceso'> Trámite de nueva libreta en proceso. Nro:<?php echo $tramiteproceso->LI_NRO; ?></label>
            </div>
        </div>
        

        <div class="form-group pull-right ">
                <?= Html::a('Ver Trámite', ['view', 'id' => $tramiteproceso->LI_NRO], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
        
        </div>

        
        <?php
    }
    else {
        $ultimotramite = LibretasController::findUltimoTramite($cliente->CL_COD);
        if ($ultimotramite!= null) { 
            ?>
            <div class="row">
                <div class="col-md-2">
                     <?='<label class=" control-label" for="fecped2">Fecha último trámite</label>' ?>
                </div>
              
                <div class="col-md-2">
                    
                        <input type="text" class="form-control" id="fecped2" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($ultimotramite->LI_FECPED, 'php:d-m-Y')."'" ?>>

                </div>

                <div class="col-md-2">
                     <?='<label class=" control-label" for="fecvto2">Vencimiento</label>' ?>
                </div>
              
                <div class="col-md-2">
                    
                        <input type="text" class="form-control" id="fecvto2" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($ultimotramite->LI_FECVTO, 'php:d-m-Y')."'" ?>>

                </div>
            </div>

            <?php 
            $fechaLab = LibretasController::vencimiento($ultimotramite->LI_FECVTO);

            $hoy = date('Y-m-d');

            $fechaLab=strtotime($fechaLab);
            $hoy=strtotime($hoy);

            $diastrasnc   = ($fechaLab-$hoy)/86400;
            $diastrasnc   = abs($diastrasnc); 
            $diastrasnc = floor($diastrasnc); 

            if($fechaLab < $hoy){
                echo "<label class='label_venc_no'>".$diastrasnc." días vencida </label>";
                ?>
                <div class="row">
                    <div class="col-md-6">
 
                        <?= $form->field($model, 'LI_TPOSER', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList( TpoSer::getListaTipoRenovacionVencida(), ['prompt' => 'Seleccione un tipo servicio..', 'onchange'=>'javascript:seleccionoTipo();']); ?>
                     </div>
                </div>

            <?php
                

            }
            else {
           
                echo "<label class='label_venc_ok'>".$diastrasnc." días para su vencimiento  </label>";

            ?>
                <div class="row">
                    <div class="col-md-6">
 
                        <?= $form->field($model, 'LI_TPOSER', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList( TpoSer::getListaTipoRenovacionNormal(), ['prompt' => 'Seleccione un tipo servicio..', 'onchange'=>'javascript:seleccionoTipo();']); ?>
                     </div>
                </div>

            <?php
            }



            ?>
            

        <?php 
        }
        else {
            ?>

            <h3>Nuevo Documento laboral</h3>
            
            
                <div class="row">
                    <div class="col-md-6">
 
                        <?= $form->field($model, 'LI_TPOSER', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList( TpoSer::getListaTipoNueva(), ['prompt' => 'Seleccione un tipo servicio..', 'onchange'=>'javascript:seleccionoTipo();']); ?>
                     </div>
                </div>
                 <div class="row">
            
           
        <?php     
        }
        ?>
            

   

        <!--<?= $form->field($model, 'LI_CONVEN')->textInput(['maxlength' => true]) ?> -->
        <div class="row">
            <div class="col-md-6">
     
                <?= $form->field($model, 'LI_CONVEN', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->dropDownList( Convenios::getListaConvenios()); ?>
            </div>
        </div>

        <div class="row">
                        <div class="col-md-6">
     
                            <?= $form->field($model, 'LI_IMPORTE', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
                         </div>
                    </div>

     

        <div class="form-group pull-right">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
        <?php 
        }

    }
    ?>
    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>
</div>
