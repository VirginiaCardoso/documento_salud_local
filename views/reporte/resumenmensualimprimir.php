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
    <table class="encabezado" style="width:100%" border="0">
        <tr >
            <td> 
                <?= Html::img('images/logo-medicinaprev.jpg', $options = ['width'=>'230'] );?>
            </td>
            <td>
                <center>
                   <!--  <h4> MES  <?= Html::encode( date('m/Y', strtotime($searchModel->mes))) ?></h4> -->
                    <br>
                   <h4> RESUMEN MENSUAL <?= Html::encode( date('m/Y', strtotime($searchModel->mes))) ?></h4>
                   <h6> Fecha de Emisión <?= date('d-m-Y') ?></h6>
               </center>
            </td>
        </tr>
        
    </table>

<?php  Pjax::begin(); 
$dataProvider->sort = false;
 ?>
<br>
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
</div>
<table class="pie" style="width:100%" border="0" cellspacing="0">
    <tr>
        <td>
        </td>
        <td>
        </td>
        <td align="right"  >
            <?php

                $sep = explode("/",$searchModel->mes);
                $anioval = $sep[0];
                $mesval = $sep[1];
                $resultados = $searchModel->calcularImportes($mesval, $anioval);
                echo "<p style='font-size:12px;'>";
                echo "Cantidad Convenio: <b>".$resultados['cantConv']."  </b><br>";
                echo "Recaudación Convenio: <b>".$resultados['recauConv']." $ </b><br><br>";
                echo "Cantidad Particular: <b>".$resultados['cantPart']."  </b><br>";
                echo "Recaudación Particular: <b>".$resultados['recauPart']." $ </b><br><br>";
                echo "<b>Recaudación Total: <b>".$resultados['recauTot']." $</b><br><br></p>";

            ?>
        </td>
    </tr>
</table>