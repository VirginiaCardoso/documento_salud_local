<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\grid\GridView;
use \kartik\grid\ExpandRowColumn;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use kartik\popover\PopoverX;

use documento_salud\assets\LibretasAsset;
use documento_salud\controllers\LibretasController;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\LibretasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs(
   "$('document').ready(function(){ 
        setInterval(function(){
            $.pjax.reload({container:'#pjax_libretas'}); 
        }, 10000);
    });"
);

LibretasAsset::register($this);

$this->title = 'Inicio trámite';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p > 
        <?= Html::a('Nuevo trámite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-md-offset-2 pull-right">
               <?php 
                $content =  '<h5> Trámites Libretas:  </h5>
                            <table>
                                <tr style="background-color: '.LibretasController::ANULADOS.'">
                                    <td class="label label-default"  >       Anulados       </td>
                                </tr>
                                <tr style="background-color: #F9F9F9">
                                    <td class="label label-default"  >       No Anulados       </td>
                                </tr>
                                
                            </table>';


            ?>
            

            <!-- Referencia de colores -->
            <?= PopoverX::widget([
            'header' => 'Referencia de Colores',
            'placement' => PopoverX::ALIGN_RIGHT_TOP,//ALIGN_RIGHT,
           'content' => $content,
            'toggleButton' => ['label'=>'Referencia de Colores', 'class'=>'btn btn-link'],
        ]);
         ?>
        </div>
    </div>
    
<?php Pjax::begin(['id'=>'pjax_libretas']) ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
                     $url = Url::to(['libretas/view', 'id' => $model['LI_NRO']]);
                    if ($model->LI_ANULADA==1) {  //tramites anulados
                        return [ 
                            'style' =>'cursor: pointer; background-color:'.LibretasController::ANULADOS,
                            'id' => $model->LI_NRO,
                            'onclick' => "window.location.href='{$url}'",
                            ];
                    }
                    else {
                        return [ 
                            'id' => $model->LI_NRO,
                            'style' =>'cursor: pointer; background-color: #F9F9F9',
                            'onclick' => "window.location.href='{$url}'",
                            ];
                    }

                    
                },

                            
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
       /*     [
                'class' => '\kartik\grid\ExpandRowColumn',
                'expandOneOnly' => true,
                'allowBatchToggle' => false,
                'expandIcon'=> GridView::ICON_EXPAND,
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => Url::to(['libretas/ver']),
                
            ],
            */
            'LI_NRO',
            'LI_FECPED:date',
            'LI_HORA',
            //'LI_COCLI',
            [
                'label' => 'Cliente',
                'value'=> function($model) {
                    if ($model->lICOCLI!=null)
                        return $model->lICOCLI->CL_APENOM;
                    else
                        return "";
                },
            ],
           // 'LI_TPOSER',
           [
                'label' => 'Tipo de trámite',
                'value'=> function($model) {
                    if ($model->lITPOSER!=null)
                        return $model->lITPOSER->TS_DESC;
                    else
                        return "";
                },
            ],
           // 'LI_CONVEN',
            // 'LI_CONSULT',
            // 'LI_ESTUD',
            // 'LI_IMPR',
            // 'LI_FECRET',
            // 'LI_IMPORTE',
            // 'LI_FECIMP',
            // 'LI_FECVTO',
            // 'LI_COMP',
            // 'LI_ANULADA',
            // 'LI_ADIC',
            // 'LI_IMPADI',
            // 'LI_REIMPR',
            // 'LI_SELECT',
            
         //    ['class' => 'yii\grid\ActionColumn',
          //    'template' => ' {view} ',],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
