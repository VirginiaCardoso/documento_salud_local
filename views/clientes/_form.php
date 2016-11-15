<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;


use documento_salud\models\TipDoc;
use documento_salud\models\Estciv;
use documento_salud\models\Locali;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

<?php $form = ActiveForm::begin([   'id' => 'formDatosPersonales',
                                            'fieldConfig' => [  'horizontalCssClasses' => [
                                                                'label' => 'col-md-2',
                                                                'wrapper' => 'col-md-10']
                                                            ],
                                            'layout' => 'horizontal']); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_COD', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
    </div>
</div>




<?= $form->field($model, 'CL_APENOM')->textInput(['maxlength' => true]) ?>

<div class="row">
    <div class="col-md-6">
 
        <?= $form->field($model, 'CL_TIPDOC', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
            ->dropDownList( TipDoc::getListaTipoDoc()); ?>
    </div>
    <div class="col-md-4">

    <?= $form->field($model, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>

 
<!--<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-8']])->textInput(['maxlength' => true]) ?>
    </div>
</div>
-->
<div class="row">
        <div class="col-md-6">
           
        <?= $form->field($model, 'CL_FECNAC',['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
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
        <div class="col-md-6">
            <?= $form->field($model, 'CL_SEXO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->dropDownList([ 'F' => 'Femenino', 'M' => 'Masculino'], ['prompt' => 'Seleccione sexo']) ?>
        </div>
</div>

<!--   <?= $form->field($model, 'CL_CODLOC')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'CL_ESTCIV')->textInput(['maxlength' => true]) ?>
-->
<div class="row">
        <div class="col-md-6">
<?= $form->field($model, 'CL_ESTCIV', 
            ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])
            ->widget(Select2::classname(), [
                        'data' =>  Estciv::getListaEstadoCivil(),
                        'options' => [
                            'placeholder' => 'Buscar estado civil...',
                             'multiple' => false,
                        ],
                        'showToggleAll' => false,
                        'pluginOptions' => [
                            'maximumInputLength' => 6,
                        ],
                    ]); ?>
         </div>
</div>


 <?= $form->field($model, 'CL_DOMICI')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'CL_CODLOC', 
            ['horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-10']])
            ->widget(Select2::classname(), [
                        'data' =>  Locali::getListaLocalidades(),
                        'options' => [
                            'placeholder' => 'Buscar Localidad ...',
                             'multiple' => false,
                        ],
                        'showToggleAll' => false,
                        'pluginOptions' => [
                            'maximumInputLength' => 10,
                        ],
                    ]); ?>
  <!--  <?= $form->field($model, 'CL_TEL')->textInput(['maxlength' => true]) ?> -->   
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_TEL', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>


    <?= $form->field($model, 'CL_LUGTRA')->textInput(['maxlength' => true]) ?>

<!--   <?= $form->field($model, 'CL_NROHAB')->textInput(['maxlength' => true]) ?> -->
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'CL_NROHAB', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <?= $form->field($model, 'CL_EMAIL')->textInput(['maxlength' => true]) ?>

<br>
<div class="row">
    <div class="col-md-2">
        <?='<label class=" control-label" for="CL_IMG"> Imágen cliente </label>' ?>
    </div>
    <div class="col-md-2">
        <?php 
        if ($model->isNewRecord) { // echo $form->field($model, 'CL_IMG')->textInput(['maxlength' => true]);

           
          
                echo "Cargar nueva  imagen";

          
        }
        else {
            $src = Yii::$app->params['path_clientes'].$model->CL_COD.'/'.$model->CL_IMG;
            echo Html::img( $src, $options = ['title' => $model->CL_IMG,
            'alt' => 'No se encontro la imágen', 'height'=>'200', 'width'=>'200'] );
            }
        ?>
    </div>
</div>
<!--
<div id="cambox" >
    <div id="webcam"></div>
    <div id="tiktik">
        <span class="timer">3</span>
        <span class="click"><img alt="take photo" src="img/camera_icon.png" onclick="capturePic()" /></span>
    </div>
    <div id="nocamera">
        <div class="message">
            Video has not detected any available cameras on your system. Please connect a camera and try again.
        </div>
    </div>
    <div id="preview">
        <img id="previewImg" alt="preview Image" height="240" width="320" src="img/preload.gif" />
        <span class="close"></span>
    </div>
</div>
-->


    <br>
        <div class="form-group pull-right">

            <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
           <?php 
            if ($model->isNewRecord)
                $parametros = ['libretas/create'];
            else
                $parametros = ['libretas/create', 'codcli' => $model->CL_COD];
        ?>
        <?= Html::a($model->isNewRecord ? 'Volver' : 'Seguir sin modificar', $parametros, ['class'=>'btn btn-danger']);?>
        </div>


    <?php ActiveForm::end(); ?>

</div>
