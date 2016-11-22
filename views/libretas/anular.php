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
use documento_salud\assets\LibretasAsset;

/* @var $this yii\web\View */
/* @var $model documento_salud\models\Libretas */
/* @var $form yii\widgets\ActiveForm */

LibretasAsset::register($this);

Pjax::begin(); 

$this->title = 'Anular Trámite';
$this->params['breadcrumbs'][] = ['label' => 'Libretas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="libretas-anular">
    
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([   'id' => 'formAnular', 'fieldConfig' => [  'horizontalCssClasses' => ['label' => 'col-md-2','wrapper' => 'col-md-10'] ],'layout' => 'horizontal']); ?>

        <h3> Seleccionar N° Documento Laboral </h3>
        <div class="row">
            <div class="col-md-2">
                <label class="control-label col-md-2">     </label>
            </div>
                <div class="col-md-10"> 
                <?=Typeahead::widget([
                    'id' => 'search-libreta',
                    'name' => 'search',
                    'options' => ['placeholder' => 'Ingrese nro trámite ...'],
                    'scrollable' => true,
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                            'remote' => [
                                'url' => Url::to(['libretas/query']) . '&q=%Q',
                                'wildcard' => '%Q'
                            ],
                            //'limit' => 20
                        ]
                    ],
                    'pluginEvents' => [
                        'typeahead:selected' => 'function(e,datum) {
                            cargarLibretas(e,datum);
                        }',
                        'typeahead:autocompleted' => 'function(e,datum) {
                            cargarLibretas(e,datum);
                        }',
                    ],
                ]);
            ?>
             </div>
             
        </div>

   <div class="row">
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_NRO', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"> 
            <?= $form->field($model, 'LI_COCLI', ['horizontalCssClasses' => ['label' => 'col-md-6', 'wrapper' => 'col-md-6']])->textInput(['readonly' => true,'maxlength' => true]) ?>
        </div>
    </div>

      <?php 
    if ($model->LI_COCLI) {   ?>
        <?= $form->field($model->lICOCLI, 'CL_APENOM')->textInput(['readonly' => true,'maxlength' => true]) ?>

    <?php }
    ?>

        <div class="form-group pull-right">
            <?= Html::submitButton( 'Anular' , ['class' =>  'btn btn-success']) ?>
           
        </div>
    
    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>
</div>