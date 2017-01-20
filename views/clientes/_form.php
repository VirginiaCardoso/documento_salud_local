<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


use documento_salud\models\TipDoc;
use documento_salud\models\Estciv;
use documento_salud\models\Locali;
use documento_salud\assets\LibretasAsset;


/* @var $this yii\web\View */
/* @var $model documento_salud\models\Clientes */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);

Pjax::begin(); 
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

    <?= $form->field($model, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6', ]])->textInput(['maxlength' => true, 'onchange'=> 'changeDoc()',]) ?>
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
            <?= $form->field($model, 'CL_SEXO', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->dropDownList([ 'F' => 'FEMENINO', 'M' => 'MASCULINO'], ['prompt' => 'Seleccione sexo']) ?>
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

        <?php 
        if ($model->isNewRecord) { 
            $labelBoton = "Tomar Foto";
            $cartel="";
            $deshabil= 'disabled';
            $nrocli = null;
            }
        else { 

            $labelBoton = "Tomar Nueva Foto";
            $cartel="";
            $deshabil= false;
            $nrocli = $model->CL_COD;

            
            ?>
            <?php    } 
            $src = Yii::$app->params['path_clientes'].$model->CL_COD.'/'.$model->CL_IMG;?>
            <div class="row">
    <div class="col-md-2">
        <?='<label class=" control-label" for="CL_IMG"> Foto </label>' ?>
    </div>
    <div class="col-md-2" id="divfoto" >
            <?php
            echo Html::img( $src, $options = ['id'=>'imgfoto','title' => $model->CL_IMG,
            'alt' => $model->isNewRecord?"":'No se encontro foto', 'height'=>Yii::$app->params['altopic'], 'width'=>Yii::$app->params['anchopic']] );
            
        ?>

      </div>
</div>
          
    
          
<div class="row">
<br>
    <div class="col-md-2"> 
        <?='<label class=" control-label" for=" ">'.$cartel.'    </label>' ?>
    </div>
    <div class="col-md-2"> 
        <?php

        echo Html::button('<span class="glyphicon glyphicon-camera"> </span> '.$labelBoton,['title' => $labelBoton,
                            'id' => "botonTomar",
                            'class' => 'verFoto btn btn-danger',
                            'value' => Url::to(['clientes/camera','doc' => $model->CL_NUMDOC , 'cli' => $nrocli]), //index.php?r=clientes%2Fcamera&cli=000337&doc=111111
                            'disabled'=>$deshabil,
                            ]);
    //   www/intranet/modulos/documento_salud/web/index.php?r=clientes%2Fcamera&doc=7774555
        ?>
    </div>
</div>

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

<?php Pjax::end(); ?>
</div>

<?php
        Modal::begin([
            'header' => 'Sacar Foto',
            'id' => 'modalFoto',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo "<div id='modalContent'>Por favor espere ...</div>";
        Modal::end();
    ?>
