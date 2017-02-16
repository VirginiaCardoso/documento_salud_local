<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */

$this->title = "Visita Médico";
$this->params['breadcrumbs'][] = ['label' => 'Historial Visitas', 'url' => ['doclabau/index', 'codcli'=>$client->CL_COD]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doclabau-view">

    <h2>Visita Médico</h2>
    <h3> <?= $client->CL_APENOM ?> </h3>
    <?php $form = ActiveForm::begin([   'id' => 'formviewdoclab', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-4','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6"> 
                    <?= $form->field($model, 'DO_CODLIB', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
            </div>
    
            <div class="row">
               
                <div class="col-md-6">
                            <div class="form-group field-libretas-li_fecped required">
                                <label class="control-label col-md-4" for="doclabau-fecha">Fecha</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="doclabau-fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->DO_VISITA, 'php:d-m-Y')."'" ?> >
                                </div>

                            </div>
                </div>
                 
            </div>
            <hr>
            <div class="row">
         
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_PESO', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        
                        ])->textInput(
                            [                               
                                'maxlength' => true,
                                'readonly' => true,
                            ])->label('Peso (kgs)') ?>
                    
                </div>
                
            </div>                           
            <div class="row">
          <div class="col-md-6">
               
      
                   <?= $form->field($model, 'talla', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label('Talla (cms)') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'DO_TENAR1', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        ])->textInput(
                            [
                        'maxlength' => true,'readonly' => true])?>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'DO_TENAR2', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        ])->textInput(
                            [
                        'maxlength' => true,'readonly' => true])?>
                </div>
                
            </div>
             <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_COLEST', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                       
                        ])->textInput(
                            [   
                               'readonly' => true,
                                'maxlength' => true]) ?>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_GLUCO', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        
                        ])->textInput(
                            [   
                                
                                'maxlength' => true,'readonly' => true]) ?>
                </div>
                           
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_PAP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
            </div>
        <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_MAM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_OBS', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(['maxlength' => true,'readonly' => true])?>
                     </div>
                </div>
            
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_CINTURA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_TRIGLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_HDL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'readonly' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                   <?= $form->field($model, 'DO_IMC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
                <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/graf_imc.jpg" witdh="" height="">
            </div>
            
        
        
    </div>
    </div>
    <?php ActiveForm::end(); ?>
    <div class="form-group">
            <div class="row">
                <div class="col-md-2 pull-right">
                    <?= Html::a('Volver' , ['doclabau/index', 'codcli'=>$client->CL_COD], ['class'=>'btn btn-primary']);?>
                </div>
            </div>
        </div>
</div>
