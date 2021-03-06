<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pool-lab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
         'layout' => 'horizontal',
    ]); ?>

    <div class="row">
        <div class="col-md-6">

        <?= $form->field($model, 'PO_FEC',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'options' => [
                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ])->label("Fecha Hasta");?>
            </div>
        
                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Limpiar',['/pool-lab/index'], ['class' => 'btn btn-default']) ?>
                    </div>
                </div>
            </div>
    

    <?php ActiveForm::end(); ?>

</div>
