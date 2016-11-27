<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use documento_salud\assets\LibretasAsset;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Devoluciones */

LibretasAsset::register($this);

$this->title = '['.$model->DE_COD.'] Modificar Devolución';
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DE_COD, 'url' => ['view', 'id' => $model->DE_COD]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devoluciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([   'id' => 'formView', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalle</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="col-md-6"> 
                        <?= $form->field($model, 'DE_COD', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                    </div>
            </div>

            <div class="row">
                    <div class="col-md-6"> 
                        <?= $form->field($model, 'DE_NROTRA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?='<label class=" control-label" for="fecha">Fecha </label>' ?>
                </div>
                  
                <div class="col-md-2">
                    
                        <input type="text" class="form-control" id="fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->DE_FECHA, 'php:d-m-Y')."'" ?>>

                </div>
            </div>
            <br>
            <div class="row">
               <div class="col-md-6"> 
                    <?= $form->field($model, 'DE_IMPORT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
                </div>

            </div>
            <div class="form-group pull-right " >
                 <?= Html::submitButton('Guardar', ['class' =>  'btn btn-primary']) ?>
                 <?= Html::a('Volver', ['index'], ['class'=>'btn btn-danger botonpanel']) ?>
            </div>
        </div>
    </div>

</div>
