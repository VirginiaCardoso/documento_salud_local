<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\dialog\Dialog;
use yii\bootstrap\ActiveForm;

use kartik\datecontrol\DateControl;
use kartik\daterange\DateRangePicker;

use documento_salud\assets\RecaudacionAsset;

/* @var $this yii\web\View */
/* @var $searchModel archivos_hc\models\PedidosFiltro */
/* @var $dataProvider yii\data\ActiveDataProvider */

RecaudacionAsset::register($this);

$this->title = 'Resumen Recaudación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resumenrecaudacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <div class="resumenrecaudacion-search">

            <?php $form = ActiveForm::begin([
                'action' => ['resumenrecaudacion'],
                'method' => 'get',
               'layout' => 'horizontal',
            ]); ?>

            <div class="row">
                <div class="col-md-2">
                         <label class="control-label">Rango Fecha</label>
                </div>
                 <div class="col-md-4">        
                 <?php  
                      $addon = <<< HTML
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
HTML;

                    
                    echo '<div class="input-group drp-container">';
                    echo $addon.DateRangePicker::widget([

                        'model'=>$searchModel,
                        'attribute' => 'rango',
                        'useWithAddon'=>true,
                        'convertFormat'=>true,
                        'startAttribute' => 'desde',
                        'endAttribute' => 'hasta',
                        'disabled' => !$filtro,
                       // 'autoclose' => true,
                        'pluginOptions'=>[
                            'locale'=>['format' => 'd-m-Y'],
                            //'autoclose' => true,
                            //'endDate' => "0d",
                        ]
                    ]);//. $addon;
                    echo '</div>';
                    ?>
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
    
        <?= Html::a('Volver',['resumenrecaudacion'],array('class'=>'btn btn-primary', 'id'=>'botonVolver'));?>
    </div>
   
    <br>

    <h3><?= Html::encode( date('d/m/Y', strtotime($searchModel->desde))) ?> a <?= Html::encode( date('d/m/Y', strtotime($searchModel->hasta))) ?></h3> 

<table style="width:100%" border="1" class="kv-grid-table table table-bordered table-striped kv-table-wrap">
    <tbody>
        <tr>
            <th rowspan="2">Clase De Servicio</th>
            <th rowspan="2"> &nbsp;</th>
            <th colspan="4">Recaudación</th>
        </tr>
        <tr>
            <th>Particular</th>
            <th>Convenio</th>
            <th>Anuladas</th>
            <th>Totales</th>
        </tr>
        <tr>
        <td>Nuevas</td>
        <td>
             <table style="width:100%" border="0">
                <tr>
                    <td>
                        Cobrado
                    </td>
                </tr>
                <tr>
                    <td>
                        Cantidad Trámites
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluciones
                    </td>
                </tr>
             </table>   
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_part['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                       &nbsp; <?= $nuevas_part['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $nuevas_part['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_conv['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;<?= $nuevas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $nuevas_conv['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_anul['recauanul']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_anul['cantanul']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_part['recau']+$nuevas_conv['recau']-$nuevas_part['dev']-$nuevas_conv['dev']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_part['cant']+ $nuevas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
      </tr>
      <tr>
        <td>Renovaciones</td>
        <td>
             <table style="width:100%" border="0">
                <tr>
                    <td>
                        Cobrado
                    </td>
                </tr>
                <tr>
                    <td>
                        Cantidad Trámites
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluciones
                    </td>
                </tr>
             </table>   
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $renov_part['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                       &nbsp; <?= $renov_part['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $renov_part['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $renov_conv['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;<?= $renov_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $renov_conv['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $renov_anul['recauanul']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $renov_anul['cantanul']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $renov_part['recau']+$renov_conv['recau']-$renov_part['dev']-$renov_conv['dev']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $renov_part['cant']+ $renov_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
      </tr>
      <tr>
        <td>Renovaciones Vencidas</td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        Cobrado
                    </td>
                </tr>
                <tr>
                    <td>
                        Cantidad Trámites
                    </td>
                </tr>
                <tr>
                    <td>
                        Devoluciones
                    </td>
                </tr>
             </table>  
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $vencidas_part['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                       &nbsp; <?= $vencidas_part['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $vencidas_part['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $vencidas_conv['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;<?= $vencidas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b> $ <?= $vencidas_conv['dev']; ?> </b>
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $vencidas_anul['recauanul']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $vencidas_anul['cantanul']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $vencidas_part['recau']+$vencidas_conv['recau']-$vencidas_part['dev']-$vencidas_conv['dev']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $vencidas_part['cant']+ $vencidas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
      </tr>
      <tr>
        <td>Totales</td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        Recaudado
                    </td>
                </tr>
                <tr>
                    <td>
                        Cantidad Trámites
                    </td>
                </tr>
            </table>  
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_part['recau']+$renov_part['recau']+$vencidas_part['recau']-$nuevas_part['dev']-$renov_part['dev']-$vencidas_part['dev']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_part['cant']+$renov_part['cant']+$vencidas_part['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_conv['recau']+$renov_conv['recau']+$vencidas_conv['recau']-$nuevas_conv['dev']-$renov_conv['dev']-$vencidas_conv['dev']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_conv['cant']+$renov_conv['cant']+$vencidas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_anul['recauanul']+$renov_anul['recauanul']+$vencidas_anul['recauanul']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_anul['cantanul']+$renov_anul['cantanul']+$vencidas_anul['cantanul']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
        <td>
            <table style="width:100%" border="0">
                <tr>
                    <td>
                        <b> $ <?= $nuevas_part['recau']+$renov_part['recau']+$vencidas_part['recau']+$nuevas_conv['recau']+$renov_conv['recau']+$vencidas_conv['recau']; ?> </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp; <?= $nuevas_part['cant']+$renov_part['cant']+$vencidas_part['cant']+$nuevas_conv['cant']+$renov_conv['cant']+$vencidas_conv['cant']; ?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
             </table>
        </td>
      </tr>
    </tbody>
</table> 
<div class="pull-right">
<?php


    $filename = $searchModel->desde."_".$searchModel->hasta;
?>
    <div class="row ">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-10">
                <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir' ,  ['reportrecaudacion', 'nombre' => $filename], [
             'class'=>'btn btn-info',
             'id' => 'btn_recaudacion',
             'target'=> '_blank',
             'data-toggle'=>'tooltip',
             'title'=> 'Imprimir']);?>

               
            </div>
                        

        </div>
    </div>
<?php } ?>


</div>