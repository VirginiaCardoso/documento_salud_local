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
LibretasAsset::register($this);

Pjax::begin(); 

$this->title = 'Ver Documento Laboral';
$this->params['breadcrumbs'][] = ['label' => 'Inspector'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-view">

    <!-- <h1>Libreta</h1>
 -->
   
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
          

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
    <div class="form-group pull-right">
            
            <?= Html::a('Volver' , ['libretas/index'], ['class'=>'btn btn-danger']);?>
        </div>
</div>
