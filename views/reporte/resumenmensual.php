<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;
use documento_salud\assets\ReporteAsset;

/* @var $this yii\web\View */
/* @var $searchModel archivos_hc\models\PedidosFiltro */
/* @var $dataProvider yii\data\ActiveDataProvider */

ReporteAsset::register($this);

$this->title = 'Resumen Mensual';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cajadiaria-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <div class="cajadiaria-search">

            <?php $form = ActiveForm::begin([
                'action' => ['resumenmensual'],
                'method' => 'get',
               'layout' => 'horizontal',
            ]); ?>

            <div class="row">
                <div class="col-md-6"> 
<!-- 'addAriaAttributes' => false, -->
                    <?= $form->field($searchModel, 'mes',[ 'horizontalCssClasses' => ['label' => 'col-md-4', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>true,
               // 'autoWidget' => false,
                'displayFormat' => 'MM/yyyy',
                'saveFormat' => 'yyyy-MM',
                'disabled' => !$filtro,
                'widgetOptions' => [

                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione un mes y año ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'startView'=>'months',
                        'minViewMode'=>'months',
                       // 'format' => 'MM-yyyy',
                    ]
                ]
            ])->label('Mes y Año');?> 
                </div>       
       
                </div>


           
            <div class="row">
                    <div class="col-md-6">
                        <?php if ($filtro) {echo Html::submitButton('Filtrar', ['class' => 'btn btn-primary', 'id'=>'botonFiltrar']);} ?>
                    </div>
               
                 </div>
            <?php ActiveForm::end(); ?>

    </div>
       

<?php 
   if (!$filtro){  ?>

    <div class="form-group">
    
        <?= Html::a('Volver',['resumenmensual'],array('class'=>'btn btn-primary', 'id'=>'botonVolver'));?>
    </div>

    
    <br>

<?php  Pjax::begin(); 

 ?>
<h3>MES <?= Html::encode( date('m/Y', strtotime($searchModel->mes))) ?></h3>
<?php 
//var_dump($dataProvider);
?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
                     
        'columns' => [

            'LI_FECPED:date',
             
             [
                'label' => 'Cant. Convenio',
                'value'=> function($model) {
                    
                        return $model->cant;
                    
                },
            ],
            [
                'label' => 'Recaud. Convenio',
                'value'=> function($model) {
                    
                        return $model->recau;
                    
                },
            ],
          
    
             [
                'label' => 'Cant. Particular',
                'value'=> function($model) {
                    
                        return $model->cant2;
                    
                },
            ],
            [
                'label' => 'Recaud. Particular',
                'value'=> function($model) {
                    
                        return $model->recau2;
                    
                },
            ],
            [
                'label' => 'Recaudación ',
                'value'=> function($model) {
                    
                        return $model->totalrecau;
                    
                },
            ],
           
        
        ],
    ]); ?>

<?php Pjax::end();  
?>
<div class="pull-right">
    <div class="row ">
       
            <?php

            $sep = explode("-",$searchModel->mes);
   
            $anioval = $sep[0];
             //  var_dump($anio)
               $mesval = $sep[1];

            $resultados = $searchModel->calcularImportes($mesval, $anioval);
         /*   $subvalores = $searchModel->calcularImporte($searchModel->dia);*/
           echo "Cantidad Convenio: ".$resultados['cantConv']."  <br>";
            echo "Recaudación Convenio: ".$resultados['recauConv']." $ <br><br>";
            echo "Cantidad Particular: ".$resultados['cantPart']."  <br>";
            echo "Recaudación Particular: ".$resultados['recauPart']." $ <br><br>";
            echo "<b>Recaudación Total: ".$resultados['recauTot']." $<b><br><br>";

            ?>
        </div>
    
<?php


    $filename = $anioval."_".$mesval;
?>
        <div class="row ">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-10">
                <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir' ,  ['reportmensual', 'nombre' => $filename], [
             'class'=>'btn btn-info',
             'id' => 'btn_imprimir_men',
             'target'=> '_blank',
             'data-toggle'=>'tooltip',
             'title'=> 'Imprimir']);?>

               
            </div>
            

        </div>
    </div>


<?php } ?>
</div>