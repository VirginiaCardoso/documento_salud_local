<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use kartik\typeahead\Typeahead;
use kartik\typeahead\Bloodhound;
use kartik\datecontrol\DateControl;

use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Devoluciones */

LibretasAsset::register($this);

Pjax::begin(); 

$this->title = 'Nueva Devolución';
$this->params['breadcrumbs'][] = ['label' => 'Devoluciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devoluciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

        <h3> Seleccionar N° Documento Laboral </h3>
        <div class="row">
        <div class="col-md-2">
                <label class="control-label col-md-2">     </label>
            </div>
            
                <div class="col-md-10"> 
                <?=Typeahead::widget([
                    'id' => 'search-libreta',
                    'name' => 'search',
                    'options' => ['placeholder' => 'Ingrese nro...'],
                    'scrollable' => true,
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                            'remote' => [
                                'url' => Url::to(['libretas/query']) . '&q=%Q',
                                'wildcard' => '%Q'
                            ],
                            //'limit' => 20
                        ]
                    ],
                    'pluginEvents' => [
                        'typeahead:selected' => 'function(e,datum) {
                            cargarLibretasDev(e,datum);
                        }',
                        'typeahead:autocompleted' => 'function(e,datum) {
                            cargarLibretasDev(e,datum);
                        }',
                    ],
                ]);
            ?>
             </div>
             
        </div>

<div class="devoluciones-form">

    <?php $form = ActiveForm::begin([   'id' => 'formCrear', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

<div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Devolución</h3>
        </div>
        <div class="panel-body">

	   <!-- <?= $form->field($model, 'DE_NROTRA')->textInput(['maxlength' => true]) ?>-->
	    <div class="row">
                <div class="col-md-6"> 
                    <?= $form->field($model, 'DE_NROTRA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="control-label col-md-2" for="clientenro">Cliente </label>
                    <div class="col-md-2">
                        <input id="clientenro" class="form-control" name="clientenro" readonly="" maxlength="12" type="text">
                    </div>
                    <div class="col-md-8">
                    <input type="text" class="form-control" id="apenom" readonly="true" value ="" >
                </div>
                </div>
            </div>
        </div>

		<br>
        <!--   <?= $form->field($model, 'DE_FECHA')->textInput() ?>

	    <?= $form->field($model, 'DE_IMPORT')->textInput(['maxlength' => true]) ?>
-->
		<div class="row">
		    <div class="col-md-2">
                <?='<label class=" control-label" for="fecha">Fecha </label>' ?>
            </div>
              
            <div class="col-md-2">
                
                    <input type="text" class="form-control" id="fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->DE_FECHA, 'php:d-m-Y')."'" ?>>

            </div>
         <!--  <div class="col-md-6"> 
			<?= $form->field($model, 'DE_FECHA',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), ['readonly' => true,
	            'type'=>DateControl::FORMAT_DATE,

	            'ajaxConversion'=>false,
	            'options' => [
	                'removeButton' => false,
	                'pluginOptions' => [
	                    'autoclose' => true
	                ]
	            ]
	        ]);
	    	?>

	    	</div>-->

        </div>
        <br>
    	<div class="row">
           <div class="col-md-6"> 
                <?= $form->field($model, 'DE_IMPORT', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
            </div>

        </div>
	  

	    <div class="form-group pull-right " >
	        <?= Html::submitButton('Crear' , ['class' => 'btn btn-success' ]) ?>
	        <?= Html::a('Volver', ['index'], ['class'=>'btn btn-danger botonpanel']) ?>
	    </div>
   	</div>
</div>

    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end(); ?>

</div>
