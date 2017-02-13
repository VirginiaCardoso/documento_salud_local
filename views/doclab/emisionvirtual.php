<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\typeahead\Typeahead;
use kartik\typeahead\Bloodhound;

use documento_salud\models\Clientes;
use documento_salud\models\TpoSer;
use documento_salud\models\Convenios;
use documento_salud\controllers\LibretasController;
use documento_salud\assets\EmisionAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
EmisionAsset::register($this);

Pjax::begin(); 

$this->title = 'Emisión Documento Laboral';
$this->params['breadcrumbs'][] = ['label' => 'Administración'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">
 
     <?php $form = ActiveForm::begin([   'id' => 'formEmision', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>
        <h3> Seleccionar Documento Laboral</h3>
        <div class="row">
                <div class="col-md-10"> 
                <?=Typeahead::widget([
                    'id' => 'search-emision',
                    'name' => 'search',
                    'options' => ['placeholder' => 'Ingrese datos para la búsqueda...'],
                    'scrollable' => true,
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                            'remote' => [
                                'url' => Url::to(['doclab/queryemision']) . '&q=%Q',
                                'wildcard' => '%Q'
                            ],
                            //'limit' => 20
                        ]
                    ],
                    'pluginEvents' => [
                        'typeahead:selected' => 'function(e,datum) {
                            cargarEmision(e,datum);
                        }',
                        'typeahead:autocompleted' => 'function(e,datum) {
                            cargarEmision(e,datum);
                        }',
                    ],
                ]);
            ?>
             </div>
             
        </div>
     <!--    <img src="<?= Url::to(['route/qrcode'])?>" /> -->
    <div id="resumen" style="display: none;">
    <div class="panel panel-default" >
        <div class="panel-heading">
            <h3 class="panel-title">Resumen Documento Laboral</h3>
        </div>
        <div class="panel-body"> 
             <div class="row">
                <div class="col-md-4"> 
                    <?= $form->field($model, 'DO_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                        <div class="form-group field-libretas-li_fecped required">
                            
                            <label class="control-label col-md-4" for="libretas-li_fecped">Fecha Solic.</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="libretas-li_fecped" readonly="true" value = "">
                            </div>

                        </div>
                </div>
                <div class="col-md-4"> 
                    <?= $form->field($lib, 'LI_HORA', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Hora Solic.") ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                             <?= $form->field($lib, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true])->label("Código Cliente")?>
                        </div>
                    </div>
                    <div class="row">
                
                        <div class="col-md-8">
                            <?= $form->field($client, 'CL_APENOM', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true])?>
                        </div>
                    </div> 
                   <div class="row">
                        <div class="col-md-8">
                            <?php 
                              /*  if ($client->cLTIPDOC) {*/
                            ?>
                               <?= $form->field($client, 'CL_TIPDOC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-4']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                            <?php  /* }*/
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">

                            <?= $form->field($client, 'CL_NUMDOC', ['horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
                        </div>
                    </div>
                    
                </div>
                 <!--    <div class="col-md-2">
                    <?='<label class=" control-label" for="CL_IMG"> Imágen cliente </label>' ?>
                </div> -->
                <div class="col-md-2">
                    <?php 
                    
                        $src = Yii::$app->params['path_clientes'];
                        echo Html::img( $src, $options = ['title' => $client->CL_IMG,
                        'alt' => 'No se encontro foto', 'width'=>Yii::$app->params['anchopic']-40 , 'id'=> 'pic'] );
                        
                    ?>
                </div>
                
                
            
            </div>

        </div>
<?php 
       // $link = Yii::$app->urlManager->createAbsoluteUrl(['doclab/view', 'id' => $client->CL_COD]);//Url::toRoute(['doclab/view', 'id' => $client->CL_COD]);
        $urlcode = Url::to(['doclab/qrcode', 'link' => ""]);
    ?>
    <img src="<?= $urlcode?>" />
    </div>
   

        <div class="form-group pull-right">
            <?= Html::a('Emitir Documento Virtual' , ['reportevirtual', 'nrodoc' => $lib->LI_NRO], ['id' => 'btGenerar','class'=>'btn btn-info']);?>
           <!--  ,'style'=>"display: none;" -->
            <?= Html::a('Limpiar' , ['doclab/emision'], ['id' => 'btVolver','class'=>'btn btn-danger']);?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
