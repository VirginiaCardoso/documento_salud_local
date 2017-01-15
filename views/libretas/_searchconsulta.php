<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\typeahead\Typeahead;
use kartik\typeahead\Bloodhound;
use kartik\datecontrol\DateControl;

use documento_salud\assets\LibretasAsset;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\LibretasSearch */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);
?>

<div class="libretas-search">

    <?php $form = ActiveForm::begin([   'id' => 'formTramite',
        'method' => 'get',
        'action' => ['/libretas/consulta-medica'],
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-4',
                                                                'wrapper' => 'col-md-6']
                                                            ],
                                            'layout' => 'horizontal']); ?>
                                            
    
    <div class="row">
         <div class="col-md-8">
            <?= $form->field($model, 'LI_FECPED',['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-4']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'options' => [
                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ]);?>
        </div>
     </div>
  <!--  <div class="row">
        <div class="col-md-6">
            <?=  $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
        </div> -->
        <?= Html::activeHiddenInput($model, 'LI_NRO') ?> 
        <?= Html::activeHiddenInput($model, 'LI_COCLI') ?> 
    <div class="row">
<div class="col-md-8">
    <div class="form-group field-libretassearch-li_busqueda">
        <label class="control-label col-md-2" for="libretassearch-li_busqueda">Cliente</label>
    <div class="col-md-8">
                <?=Typeahead::widget([
                    'id' => 'search-estado',
                    'name' => 'search',
                    'options' => ['placeholder' => 'Ingrese datos para buscar un cliente...'],
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
                            cargarNro(e,datum);
                        }',
                        'typeahead:autocompleted' => 'function(e,datum) {
                            cargarNro(e,datum);
                        }',
                    ],
                ]);
            ?>
        </div>

        <div class="help-block help-block-error "></div>

    </div>
    </div>

             
        <div class="col-sm-1">
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-sm-1"> 
            <?= Html::a('Limpiar',['/libretas/consulta-medica'], ['class' => 'btn btn-default']) ?>  
           
        </div>
        
    </div>

    
    

    <?php ActiveForm::end(); ?>

</div>
