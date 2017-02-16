<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use documento_salud\assets\DoclabauAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Doclabau */
/* @var $form yii\widgets\ActiveForm */

DoclabauAsset::register($this);

?>

<div class="doclabau-form">

   <?php $form = ActiveForm::begin([   'id' => 'formdoclabau', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-4','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
   <h3> <?= $client->CL_APENOM ?> </h3>

    <div class="row">
            <div class="col-md-6"> 
                <?= $form->field($model, 'DO_CODLIB', [
                    'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
    </div>
    
    <div class="row">
       
        <div class="col-md-6">
                    <div class="form-group field-libretas-li_fecped required">
                        <?= Html::activeHiddenInput($model, 'DO_VISITA') ?>
                        <label class="control-label col-md-4" for="doclabau-fecha">Fecha</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="doclabau-fecha" readonly="true" value = <?= "'".Yii::$app->formatter->asDate($model->DO_VISITA, 'php:d-m-Y')."'" ?> >
                        </div>

                    </div>
        </div>
         <div class="col-md-2 pull-right"> 
                <?= Html::a('Historial Visitas' , ['doclabau/index', 'codcli'=>$lib->LI_COCLI], ['class'=>'btn btn-info']);?>
            </div>   
    </div>
    <br>
        <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Información Nueva Visita</h3>
        </div>
        <div class="panel-body">

            <div class="row">
         
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_PESO', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        
                        ])->textInput(
                            [   
                                
                                'maxlength' => true,
                                'onchange'=>'javascript:mostrar_diferencia();'
                            ])->label('Peso (kgs)') ?>
                    
                </div>
                <?php 
                if ($anterior!=null) {
                ?>

                    <div class="col-md-4">
                       <div class="form-group field-anterior-peso ">
                            <label class="control-label col-md-4" for="anterior-peso">Anterior</label>
                            <div class="col-md-4">
                                <input type="text" id="anterior-peso" class="form-control" name="anterior-peso" value=<?= "'".$anterior->DO_PESO."'" ?> readonly maxlength="7" aria-required="true">
                                <div class="help-block help-block-error "></div>
                            </div>

                        </div>
                    </div>
                   
                    <div class="col-md-4">
          
                       <?= $form->field($model, 'diferencia', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Diferencia") ?>
                    </div>
                <?php 
                }
                ?>
            </div>                           
            <div class="row">
          <div class="col-md-4">
               
      
                   <?= $form->field($model, 'talla', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label('Talla (cms)') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'tension', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        ])->textInput(
                            [
                        'maxlength' => true])->label("Tensión Arterial") ?>
                </div><!-- , 'pattern'=>"[0-9]+\/[0-9]+" -->
                
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-4">
                       <div class="form-group field-anterior-tension ">
                            <label class="control-label col-md-4" for="anterior-tension">Anterior</label>
                            <div class="col-md-4">
                                <input type="text" id="anterior-tension" class="form-control" name="anterior-tension" value=<?= "'".$anterior->tension."'" ?> readonly maxlength="7" aria-required="true">
                                <div class="help-block help-block-error "></div>
                            </div>

                        </div>
                    </div>
                
                
                <?php
                }
                ?>
            </div>
             <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_COLEST', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                       
                        ])->textInput(
                            [   
                               
                                'maxlength' => true]) ?>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-4">
                       <div class="form-group field-anterior-colest ">
                            <label class="control-label col-md-4" for="anterior-colest">Anterior</label>
                            <div class="col-md-4">
                                <input type="text" id="anterior-colest" class="form-control" name="anterior-colest" value=<?= "'".$anterior->DO_COLEST."'" ?> readonly maxlength="7" aria-required="true">
                                <div class="help-block help-block-error "></div>
                            </div>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_GLUCO', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        
                        ])->textInput(
                            [   
                                
                                'maxlength' => true]) ?>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-4">
                       <div class="form-group field-anterior-gluco ">
                            <label class="control-label col-md-4" for="anterior-gluco">Anterior</label>
                            <div class="col-md-4">
                                <input type="text" id="anterior-gluco" class="form-control" name="anterior-gluco" value=<?= "'".$anterior->DO_GLUCO."'" ?> readonly maxlength="7" aria-required="true">
                                <div class="help-block help-block-error "></div>
                            </div>

                        </div>
                    </div>
                <?php
                    }
                    ?>
            </div>
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_PAP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_MAM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-8">
                       <?= $form->field($model, 'DO_OBS', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])->textArea(['maxlength' => true])?>
                     </div>
                </div>
            
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_CINTURA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_TRIGLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_HDL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
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
            
        
        <div class="form-group">
            <div class="row">
                <div class="col-md-2 pull-right">
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
