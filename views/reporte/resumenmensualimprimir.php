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
                'label' => 'Cantidad Convenio',
                'value'=> function($model) {
                    
                        return $model->cant;
                    
                },
            ],
            [
                'label' => 'Recaudación Convenio',
                'value'=> function($model) {
                    
                        return $model->recau;
                    
                },
            ],
          
    
             [
                'label' => 'Cantidad Particular',
                'value'=> function($model) {
                    
                        return $model->cant2;
                    
                },
            ],
            [
                'label' => 'Recaudación Particular',
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
