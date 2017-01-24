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

   <?php $form = ActiveForm::begin([   'id' => 'formdoclabau', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

    <div class="row">
            <div class="col-md-6"> 
                <?= $form->field($model, 'DO_CODLIB', [
                    'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
            </div>
    </div>
    
    <div class="row">
       <!--  <div class="col-md-6"> 
            <?= $form->field($model, 'DO_VISITA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div> -->
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
                        'selectors' => [
                            'input' => '#model-do_peso',
                            'container' => '#model-do_peso-container',
                        ],
                        'options' => ['id' => 'model-do_peso-container'],
                        ])->textInput(
                            [   
                                'name'=> 'Doclabau[DO_PESO]', 
                                'id'=>'model-do_peso',
                                'maxlength' => true,
                                'onchange'=>'javascript:mostrar_diferencia();'
                            ]) ?>
                    <?= Html::activeHiddenInput($model, 'talla') ?>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-4">

                       <?= $form->field($anterior, 'DO_PESO', [
                            'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                            'selectors' => [
                                'input' => '#anterior-do_peso',
                                'container' => '#anterior-do_peso-container',
                            ],
                            'options' => ['id' => 'anterior-do_peso-container'],
                       ])->textInput([
                            'name'=> 'Anterior[DO_PESO]', 
                            'id'=>'anterior-do_peso',
                            'readonly' => true,
                            'maxlength' => true,
                            ])->label("Anterior") ?>
                    </div>
                    <div class="col-md-4">
          
                       <?= $form->field($model, 'diferencia', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Diferencia") ?>
                    </div>
                <?php 
                }
                ?>
            </div>
            


            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'DO_TENAR1', [
                                'horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6'],
                                'selectors' => [
                                    'input' => '#model-do_tenar1',
                                    'container' => '#model-do_tenar1-container',
                                ],
                                'options' => ['id' => 'model-do_tenar1-container'],
                                ])->textInput(
                                    [   
                                'name'=> 'Doclabau[DO_TENAR1]', 
                                'id'=>'model-do_tenar1',
                                'maxlength' => true]) ?>
                        </div>
                
                        <div class="col-md-4">   
                            <?= $form->field($model, 'DO_TENAR2', [
                            'horizontalCssClasses' => [ 'offset' => '', 'wrapper' => 'col-md-6'],
                            'selectors' => [
                                    'input' => '#model-do_tenar2',
                                    'container' => '#model-do_tenar2-container',
                                ],
                                'options' => ['id' => 'model-do_tenar2-container'],
                                ])->textInput(
                                    [   
                                'name'=> 'Doclabau[DO_TENAR2]', 
                                'id'=>'model-do_tenar2',
                            ])->textInput(['maxlength' => true])->label(false) ?>
                        </div>
                    </div>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($anterior, 'DO_TENAR1', [
                            'horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6'],
                            'selectors' => [
                                'input' => '#anterior-do_tenar1',
                                'container' => '#anterior-do_tenar1-container',
                            ],
                            'options' => ['id' => 'anterior-do_tenar1-container'],
                       ])->textInput([
                            'name'=> 'Anterior[DO_TENAR1]', 
                            'id'=>'anterior-do_tenar1',
                            'readonly' => true,
                            'maxlength' => true])->label('Tensión Arterial Anterior') ?>
                        </div>
                
                        <div class="col-md-4">   
                            <?= $form->field($anterior, 'DO_TENAR2', [
                            'horizontalCssClasses' => [ 'offset' => '', 'wrapper' => 'col-md-6'],
                            'selectors' => [
                                'input' => '#anterior-do_tenar2',
                                'container' => '#anterior-do_tenar2-container',
                            ],
                            'options' => ['id' => 'anterior-do_tenar2-container'],
                       ])->textInput([
                            'name'=> 'Anterior[DO_TENAR2]', 
                            'id'=>'anterior-do_tenar2',
                            'readonly' => true,
                            'maxlength' => true])->label(false) ?>
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
                        'selectors' => [
                            'input' => '#model-do_colest',
                            'container' => '#model-do_colest-container',
                        ],
                        'options' => ['id' => 'model-do_colest-container'],
                        ])->textInput(
                            [   
                                'name'=> 'Doclabau[DO_COLEST]', 
                                'id'=>'model-do_colest',
                                'maxlength' => true]) ?>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-4">
          
                       <?= $form->field($anterior, 'DO_COLEST', [
                       'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                            'selectors' => [
                                'input' => '#anterior-do_colest',
                                'container' => '#anterior-do_colest-container',
                            ],
                            'options' => ['id' => 'anterior-do_colest-container'],
                       ])->textInput([
                            'name'=> 'Anterior[DO_COLEST]', 
                            'id'=>'anterior-do_colest',
                            'readonly' => true,
                            'maxlength' => true])->label("Anterior") ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_GLUCO', [
                        'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                        'selectors' => [
                            'input' => '#model-do_gluco',
                            'container' => '#model-do_gluco-container',
                        ],
                        'options' => ['id' => 'model-do_gluco-container'],
                        ])->textInput(
                            [   
                                'name'=> 'Doclabau[DO_GLUCO]', 
                                'id'=>'model-do_gluco',
                                'maxlength' => true]) ?>
                </div>
                <?php 
                if ($anterior!=null) {
                ?>
                    <div class="col-md-6">
          
                       <?= $form->field($anterior, 'DO_GLUCO', [
                            'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4'],
                            'selectors' => [
                                'input' => '#anterior-do_gluco',
                                'container' => '#anterior-do_gluco-container',
                            ],
                            'options' => ['id' => 'anterior-do_gluco-container'],
                       ])->textInput([
                            'name'=> 'Anterior[DO_GLUCO]', 
                            'id'=>'anterior-do_gluco',
                            'readonly' => true,
                            'maxlength' => true])->label("Anterior") ?>
                    </div>
                <?php
                    }
                    ?>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_PAP', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_MAM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                       <?= $form->field($model, 'DO_OBS', ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-8']])->textArea(['maxlength' => true])?>
                     </div>
                </div>
            
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_CINTURA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_TRIGLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_HDL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
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
