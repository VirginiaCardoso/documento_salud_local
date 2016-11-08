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

use documento_salud\controllers\LibretasController;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\LibretasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inicio trámite';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p > 
        <?= Html::a('Nuevo trámite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
<?php Pjax::begin(['id'=>'pjax-llamadas']) ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
                    if ($model->LI_ANULADA==1)  //tramites anulados
                        return [ 'style' =>'background-color:'.LibretasController::ANULADOS];
                    
                },
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => '\kartik\grid\ExpandRowColumn',
                'expandOneOnly' => true,
                'allowBatchToggle' => false,
                'expandIcon'=> GridView::ICON_EXPAND,
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detailUrl' => Url::to(['libretas/ver']),
                /*'detailOptions' => function ($model, $key, $index, $column) {
                    return [
                        'style' => 'border: 1px solid #'.$model->colorAtencion->CA_COLOR.'; background-color:#'.$model->colorAtencion->CA_COLOR
                    ];
                }*/
            ],
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
            
            // 'LI_FHIMPOR',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
