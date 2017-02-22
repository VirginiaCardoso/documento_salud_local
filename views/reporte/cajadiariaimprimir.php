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
    <table class="encabezado" style="width:100%" border="0">
        <tr >
            <td> 
                <?= Html::img('images/logo-medicinaprev.jpg', $options = ['width'=>'230'] );?>
            </td>
            <td>
                <center>
                    <h4> AÑO <?= date('Y') ?></h4>
                    <br>
                   <h4> PLANILLA DE RENDICION <?= Html::encode(date("d-m-Y",strtotime($searchModel->dia))) ?></h4>
                   <h6> Fecha de Emisión <?= date('d-m-Y') ?></h6>
               </center>
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
            <td>
                <table class="textocajero"  border="0" align="right" >
                    <tr >
                        <td align="right" >
                              <?= Html::img('images/firmacajero.jpg', $options = ['width'=>'330'] );?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

<?php  Pjax::begin(); 
$dataProvider->sort = false;
 ?>
<br>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
       'emptyText' => '',
            'summary'=>"",
           
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
</div>
<table class="pie" style="width:100%" border="0" cellspacing="0">
    <tr>
        <td>
        </td>
        <td>
        </td>
        <td align="right"  >
            <?php
            $subvalores = $searchModel->calcularImporte($searchModel->dia);
            echo "<b>Sub- Totales </b><br>";
            echo "Importes: ".$subvalores['subimporte']." $ <br>";
            echo "Devoluciones: ".$subvalores['subdevol']." $ <br><br>";
            $resta = floatval($subvalores['subimporte'])- floatval($subvalores['subdevol']);
            echo "<b> Total: ".$resta." $<b>";

            ?>
        </td>
    </tr>
    <tr >
        <td style="width:20%"> 
            Recibo Tesorería N° 
        </td>
        <td align="left" >
         
                <p style="font-size:8px;">
                    <br><br><br><br>
                   -------------------------------------------------------------
                   <br>
                </p>
             
        </td>
        <td>
            <center>
                <p style="font-size:8px; text-align:center;">
                    <br><br><br><br>
                   --------------------------------------------------------------------------------------- <br>
                   FIRMA TESORERIA 
                </p>
            </center>
        </td>
    </tr>
</table>