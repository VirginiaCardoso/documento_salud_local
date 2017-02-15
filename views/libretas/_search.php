<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use documento_salud\assets\LibretasAsset;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\LibretasSearch */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);
?>

<div class="libretas-search">

     <?php $form = ActiveForm::begin([
        'action' => ['/libretas/index'],
        'method' => 'get',
         'layout' => 'horizontal',
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?=  $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true])->label('Cliente') ?>
        </div>
        <div class="col-md-6 form-group">
            <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Limpiar',['/libretas/index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    
    

    <?php ActiveForm::end(); ?>

</div>
