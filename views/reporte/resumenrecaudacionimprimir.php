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

$this->title = 'Resumen Recaudación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resumenrecaudacion-index">
    <table class="encabezado" style="width:100%" border="0">
        <tr >
            <td> 
                <?= Html::img('images/logo-medicinaprev.jpg', $options = ['width'=>'230'] );?>
            </td>
            <td>
                <center>
                   <br>
                   <h4> RESUMEN RECAUDACION </h4>
                   <h4> (<?= Html::encode( date('d/m/Y', strtotime($searchModel->desde))) ?> a <?= Html::encode( date('d/m/Y', strtotime($searchModel->hasta))) ?>)</h4>
                   <h6> Fecha de Emisión <?= date('d-m-Y') ?></h6>
               </center>
            </td>
        </tr>
        
    </table>

    <br>

    <table style="width:100%" border="1" class="kv-grid-table table table-bordered table-striped kv-table-wrap">
        <tbody>
            <tr>
                <th rowspan="2" border="0">Clase De Servicio</th>
                <th rowspan="2" border="0"> &nbsp;</th>
                <th colspan="4" border="0">Recaudación</th>
            </tr>
            <tr>
                <th border="0">Particular</th>
                <th border="0">Convenio</th>
                <th border="0">Anuladas</th>
                <th border="0">Totales</th>
            </tr>
            <tr>
                <td >Nuevas</td>
                <td>
                     <table style="width:100%" border="0" class=" table-borde2 " >
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
                        <tr>
                            <td>
                                <b> $ <?= $nuevas_part['recau']+$nuevas_conv['recau']; ?> </b>
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
                     <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                    <table style="width:100%" border="0"  class=" table-borde2 ">
                        <tr>
                            <td>
                                <b> $ <?= $renov_part['recau']+$renov_conv['recau']; ?> </b>
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
          <tr >
                <td >Renovaciones Vencidas</td>
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
                        <tr>
                            <td>
                                <b> $ <?= $vencidas_part['recau']+$vencidas_conv['recau']; ?> </b>
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
          <tr >
                <td >Totales</td>
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
                        <tr>
                            <td>
                                <b> $ <?= $nuevas_part['recau']+$renov_part['recau']+$vencidas_part['recau']; ?> </b>
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
                        <tr>
                            <td>
                                <b> $ <?= $nuevas_conv['recau']+$renov_conv['recau']+$vencidas_conv['recau']; ?> </b>
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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
                <td >
                    <table style="width:100%" border="0"  class=" table-borde2 ">
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

</div>
