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
                <?= $form->field($model, 'DO_CODLIB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
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
                <?= Html::a('Historial Visitas' , ['doclabau/index', 'id'=>$model->DO_CODLIB], ['class'=>'btn btn-info']);?>
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
      
                   <?= $form->field($model, 'DO_PESO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true,'onchange'=>'javascript:mostrar_diferencia();']) ?>
                </div>
                <div class="col-md-4">
      
                   <?= $form->field($modelant, 'DO_PESO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true,'id'=>'peso-ant'])->label("Anterior") ?>
                </div>
                <div class="col-md-4">
      
                   <?= $form->field($model, 'diferencia', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Diferencia") ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_TENAR1', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
      
                   /
                </div>
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_TENAR2', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>
             <div class="row">
                <div class="col-md-4">
      
                   <?= $form->field($model, 'DO_COLEST', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
      
                   <?= $form->field($modelant, 'DO_COLEST', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true,'id'=>'colest-ant'])->label("Anterior") ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
      
                   <?= $form->field($model, 'DO_GLUCO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
      
                   <?= $form->field($modelant, 'DO_GLUCO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true,'id'=>'gluco-ant'])->label("Anterior") ?>
                </div>
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
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>