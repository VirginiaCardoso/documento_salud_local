<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use documento_salud\assets\LibretasAsset;
use kartik\datecontrol\DateControl;

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
         <div class="col-md-6">
            <?= $form->field($model, 'LI_FECPED',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
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
    <div class="row">
        <div class="col-md-6">
            <?=  $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
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
