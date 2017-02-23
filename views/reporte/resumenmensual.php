<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;
use documento_salud\models\CajaDiaraFiltro;
use documento_salud\assets\CajaDiariaAsset;

/* @var $this yii\web\View */
/* @var $searchModel archivos_hc\models\PedidosFiltro */
/* @var $dataProvider yii\data\ActiveDataProvider */

CajaDiariaAsset::register($this);

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
                    <?= $form->field($searchModel, 'mes',[ 'horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'displayFormat' => 'MM/yyyy',
                'options' => [

                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione un mes ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'startView'=>'months',
                        'minViewMode'=>'months',
                       // 'format' => 'MM-yyyy',
                    ]
                ]
            ]);?> 
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

<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
                     
        'columns' => [
           /* [
                'label' => 'Anulada',
                'value'=> function($model) {
                    if ($model->LI_ANULADA==0)
                        return "NO";
                    else
                        return "SI";
                },
            ],
            'LI_NRO',*/
            'LI_FECPED:date',
        /*    'LI_HORA',
            [
                'label' => 'Cliente',
                'value'=> function($model) {
                    if ($model->lICOCLI!=null)
                        return $model->lICOCLI->CL_APENOM;
                    else
                        return "";
                },
            ],
         */  [
                'label' => 'Tipo de trámite',
                'value'=> function($model) {
                    if ($model->lITPOSER!=null)
                        return $model->lITPOSER->TS_DESC;
                    else
                        return "";
                },
            ],
           /*  [
                'label' => 'Importe',
                'value'=> function($model) {
                    if ($model->LI_IMPORTE!=null) {
                       // $subimporte = $subimporte + $model->LI_IMPORTE;
                        return $model->LI_IMPORTE;
                    }
                    else
                        return "0.00";
                },
            ],    */     
             [
                'label' => 'Cantidad',
                'value'=> function($model) {
                    
                        return $model->cant;
                    
                },
            ],
            [
                'label' => 'Recaudación',
                'value'=> function($model) {
                    
                        return $model->recau;
                    
                },
            ], 
            
        ],
    ]); ?>

<?php Pjax::end();  
?>
<div class="pull-right">
    <div class="row ">
        <div >
            <?php
         /*   $subvalores = $searchModel->calcularImporte($searchModel->dia);
            echo "<b>Sub- Totales </b><br>";
            echo "Importes: ".$subvalores['subimporte']." $ <br>";
            echo "Devoluciones: ".$subvalores['subdevol']." $ <br><br>";
            
            $resta = floatval($subvalores['subimporte'])- floatval($subvalores['subdevol']);
            echo "<b> Total: ".$resta." $<b><br><br>";*/

            ?>
        </div>
    </div>

        <div class="row ">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-10">
                <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir' ,  ['reportmensual', 'nombre' => $searchModel->mes], [
             'class'=>'btn btn-info',
             'id' => 'btn_imprimir',
             'target'=> '_blank',
             'data-toggle'=>'tooltip',
             'title'=> 'Imprimir']);?>

               
            </div>
                        

        </div>
    </div>


<?php } ?>
</div>