<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\typeahead\Typeahead;
use kartik\typeahead\Bloodhound;


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

$this->title = 'Estado Documento Laboral';
$this->params['breadcrumbs'][] = ['label' => 'Tesorería'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="libretas-estado">
    
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([   'id' => 'formEstado', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>


        <h3> Seleccionar Cliente</h3>
        <div class="row">
            <div class="col-md-2">
                <label class="control-label col-md-2">     </label>
            </div>
                <div class="col-md-10"> 
                <?=Typeahead::widget([
                    'id' => 'search-estado',
                    'name' => 'search',
                    'options' => ['placeholder' => 'Ingrese datos para la búsqueda...'],
                    'scrollable' => true,
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                            'remote' => [
                                'url' => Url::to(['libretas/query3']) . '&q=%Q',
                                'wildcard' => '%Q'
                            ],
                            //'limit' => 20
                        ]
                    ],
                    'pluginEvents' => [
                        'typeahead:selected' => 'function(e,datum) {
                            cargarEstado(e,datum);
                        }',
                        'typeahead:autocompleted' => 'function(e,datum) {
                            cargarEstado(e,datum);
                        }',
                    ],
                ]);
            ?>
             </div>
             
        </div>
<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Documento Laboral</h3>
        </div>
        <div class="panel-body">
           <div class="row">
                <div class="col-md-4"> 
                    <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4"> 
                    <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>

                <div class="col-md-8">
                    <input type="text" class="form-control" id="apenom" readonly="true" value ="" >
                </div>
            </div>
            <div class="row" id= "label-fecha">
                <div class="col-md-6">
                    <div class="form-group ">
                        <label  class="control-label col-md-4" for="fecha">Fecha Vencimiento</label>
                        <div class="col-md-4">
                            <input id="fecha" class="form-control" name="fecha" readonly="" maxlength="12" type="text">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            
            <div class="row">
                <div class="col-md-12 ">
                    <label id='label_info'> </label>
                </div>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>
</div>
