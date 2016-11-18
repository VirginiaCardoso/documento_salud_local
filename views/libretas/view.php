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

    <h1><?= Html::encode($this->title) ?></h1>

   
     <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_FECPED', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label("Fecha Solicitud") ?>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Hora Solicitud") ?>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
        </div>

        <hr />

        <h3>Cliente</h3>
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

        <hr />

        <h3>Libreta</h3>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'LI_TPOSER', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'LI_CONVEN', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'LI_CONSULT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])->label('¿Consulta médica realizada?') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
             
               
            </div>
        </div>

        

    <?php ActiveForm::end(); ?>

     <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->LI_NRO], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->LI_NRO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
