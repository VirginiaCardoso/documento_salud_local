<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use documento_salud\models\Clases;
use documento_salud\models\TipoServicio;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\TpoSer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tpo-ser-form">

    <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales',
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-2',
                                                                'wrapper' => 'col-md-10']
                                                            ],
                                            'layout' => 'horizontal']); ?>

    <?= $form->field($model, 'TS_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TS_DESC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TS_IMP')->textInput(['maxlength' => true]) ?>

   <!-- <?= $form->field($model, 'TS_CLASE')->textInput(['maxlength' => true]) ?>
-->
    <div class="row">
        <div class="col-md-6">
     
            <?= $form->field($model, 'TS_CLASE', 
                ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
                ->dropDownList( Clases::getLista()); ?>
        </div>
        
    </div>
    <div class="row">
    <div class="col-md-6">
 
        <?= $form->field($model, 'TS_TIPO', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
            ->dropDownList( TipoServicio::getLista()); ?>
    </div>
    
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Volver',['index'],array('class'=>'btn btn-danger'));?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
