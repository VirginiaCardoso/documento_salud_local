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

use documento_salud\assets\PoolAsset;
use documento_salud\controllers\PoolLabController;
/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\PoolLabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudios Complementarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pool-lab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-md-offset-2 pull-right">
               <?php 
                $content =  '<h5> Estudios Complementarios:  </h5>
                            <table>
                                <tr style="background-color: '.PoolLabController::SIN_EXTRACC.'">
                                    <td class="label"  >       Sin Muestras       </td>
                                </tr>
                                <tr style="background-color: '.PoolLabController::CON_EXTRACC.'">
                                    <td class="label "  >       Con Muestras       </td>
                                </tr>
                                <tr style="background-color: #F9F9F9">
                                    <td class="label"  >       Listos       </td>
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

<?php Pjax::begin(); ?>  
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
       'rowOptions' => function ($model, $key, $index, $grid) {
                   //  $url = Url::to(['libretas/view', 'id' => $model['LI_NRO']]);
                    if ($model->PO_MUESTRA==0) {  //no se hizo la muestra
                        return [ 
                            'style' =>'cursor: pointer; background-color:'.PoolLabController::SIN_EXTRACC,
                           // 'id' => $model->LI_NRO,
                           // 'onclick' => "window.location.href='{$url}'",
                            ];
                    }
                    else {
                        return [ 
                           // 'id' => $model->LI_NRO,
                            'style' =>'cursor: pointer; background-color:'.PoolLabController::CON_EXTRACC,
                           // 'onclick' => "window.location.href='{$url}'",
                            ];
                    }

                    
                },

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'PO_FEC:date',
            'PO_HORA',
            'PO_NROLIB',
            //'LI_COCLI',
            [
                'label' => 'Cliente',
                'value'=> function($model) {
                    if ($model->pONROLIB!=null)
                        return $model->pONROLIB->lICOCLI->CL_APENOM;
                    else
                        return "";
                },
            ],
             [
                'label' => 'Tipo',
                'value'=> function($model) {
                    if ($model->pONROLIB!=null)
                        return $model->pONROLIB->lITPOSER->TS_DESC;
                    else
                        return "";
                },
            ],
           // 'PO_COLEST',
           // 'PO_GLUCOSA',
            // 'PO_MUESTRA',
            // 'PO_LISTO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
