<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

LibretasAsset::register($this);

$this->title = $model->PO_NROLIB;
$this->params['breadcrumbs'][] = ['label' => 'Estudios Complementarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pool-lab-view">

    <h1>Extracción y Muestra</h1>

    <?php $form = ActiveForm::begin([   'id' => 'formDatosMuestras', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">¿Confirma la extracción y toma de muestra?  </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'PO_NROLIB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true, 'readonly' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group field-fecha required">
                            <label class="control-label col-md-4" for="fecha">Fecha</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->PO_FEC, 'php:d-m-Y')."'" ?>>
                                <div class="help-block help-block-error "></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <?= $form->field($model, 'PO_HORA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group field-muestra required">
                            <label class="control-label col-md-4" for="muestra">Muestra</label>
                            <div class="col-md-4">
                                 <input type="text" class="form-control" id="muestra" readonly="true" value = <?= "'".$model->PO_MUESTRA==1?"Si":"No" ?>>
                                <div class="help-block help-block-error "></div>

                            </div>
                        </div>
                    </div>
                </div>
                

               <div class="form-group  pull-right">
       <!-- <h4> Confirma la extracción y toma de muestra? </h4>-->
        <?= Html::a('Confirmar', ['confirmar-muestra', 'id' => $model->PO_NROLIB], ['class' => 'btn btn-success botonpanel']) ?>
    </div>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

    

</div>
