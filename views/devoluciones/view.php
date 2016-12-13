<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use documento_salud\assets\LibretasAsset;

LibretasAsset::register($this);


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Devoluciones */

$this->title = '['.$model->DE_COD.'] Devolución';
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devoluciones-view">

    <h1>Devolución</h1>

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
                    <?= $form->field($model, 'DE_IMPORT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>

            </div>
            <div class="form-group pull-right " >
                <?= Html::a('Modificar', ['update', 'id' => $model->DE_COD], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->DE_COD], [
                    'class' => 'btn btn-danger botonpanel',
                    'data' => [
                        'confirm' => '¿Está seguro de eliminar este elemento?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
