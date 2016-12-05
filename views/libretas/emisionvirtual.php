<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

use documento_salud\models\Clientes;
use documento_salud\models\TpoSer;
use documento_salud\models\Convenios;
use documento_salud\controllers\LibretasController;
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */

$this->title = 'Libreta: '.$model->LI_NRO;
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <h1>Libreta</h1>

   
     <?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>


        </div>

        <img src="<?= Url::to(['route/qrcode'])?>" />
          

    <?php ActiveForm::end(); ?>

    <div class="form-group pull-right">
            
            <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
</div>
