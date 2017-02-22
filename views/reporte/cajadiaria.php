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

$this->title = 'Caja Diaria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cajadiaria-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <div class="cajadiaria-search">

            <?php $form = ActiveForm::begin([
                'action' => ['cajadiaria'],
                'method' => 'get',
               'layout' => 'horizontal',
            ]); ?>

            <div class="row">
                <div class="col-md-6"> 
<!--   -->
                    <?= $form->field($searchModel, 'dia',[ 'addAriaAttributes' => false,'horizontalCssClasses' => ['label' => 'col-md-2', 'wrapper' => 'col-md-6']])->widget(DateControl::classname(), [
                'type'=>DateControl::FORMAT_DATE,
                'ajaxConversion'=>false,
                'displayFormat' => 'dd/MM/yyyy',
                'options' => [
                    'removeButton' => false,
                    'options' => ['placeholder' => 'Seleccione una fecha ...'],
                    'pluginOptions' => [
                        'autoclose' => true
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
    
        <?= Html::a('Volver',['cajadiaria'],array('class'=>'btn btn-primary', 'id'=>'botonVolver'));?>
    </div>

    
    <br>

<?php  Pjax::begin(); 

 ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
                     
        'columns' => [
            [
                'label' => 'Anulada',
                'value'=> function($model) {
                    if ($model->LI_ANULADA==0)
                        return "NO";
                    else
                        return "SI";
                },
            ],
            'LI_NRO',
            'LI_FECPED:date',
            'LI_HORA',
            [
                'label' => 'Cliente',
                'value'=> function($model) {
                    if ($model->lICOCLI!=null)
                        return $model->lICOCLI->CL_APENOM;
                    else
                        return "";
                },
            ],
           [
                'label' => 'Tipo de trámite',
                'value'=> function($model) {
                    if ($model->lITPOSER!=null)
                        return $model->lITPOSER->TS_DESC;
                    else
                        return "";
                },
            ],
             [
                'label' => 'Importe',
                'value'=> function($model) {
                    if ($model->LI_IMPORTE!=null) {
                       // $subimporte = $subimporte + $model->LI_IMPORTE;
                        return $model->LI_IMPORTE;
                    }
                    else
                        return "0.00";
                },
            ],           
             [
                'label' => 'Devoluciones',
                'value'=> function($model) {
                    if ($model->devolu!=null) {
                      //  $subdevol = $subdevol + $model->devolu->DE_IMPORT;
                        return $model->devolu->DE_IMPORT;
                    }
                    else
                        return "0.00";
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
            $subvalores = $searchModel->calcularImporte($searchModel->dia);
            echo "<b>Sub- Totales </b><br>";
            echo "Importes: ".$subvalores['subimporte']." $ <br>";
            echo "Devoluciones: ".$subvalores['subdevol']." $ <br><br>";
            
            $resta = floatval($subvalores['subimporte'])- floatval($subvalores['subdevol']);
            echo "<b> Total: ".$resta." $<b><br><br>";

            ?>
        </div>
    </div>

        <div class="row ">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-10">
                <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir' ,  ['reportcajadiaria', 'nombre' => $searchModel->dia], [
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