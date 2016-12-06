<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\PoolLab */

$this->title = 'Cargar datos muestras: ' . $model->PO_NROLIB;
$this->params['breadcrumbs'][] = ['label' => 'Pool Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PO_NROLIB, 'url' => ['view', 'id' => $model->PO_NROLIB]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pool-lab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="pool-lab-form">

     <?php $form = ActiveForm::begin([   'id' => 'formDatosMuestras', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>


    <?= $form->field($model, 'PO_NROLIB')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'PO_COLEST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PO_GLUCOSA')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar' , ['class' =>  'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
