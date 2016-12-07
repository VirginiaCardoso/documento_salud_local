<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\grid\GridView;
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
        //actualiza la pagina si no hay filas seleccionadas
        setInterval(function(){
            if( ($('#gridCons').yiiGridView('getSelectedRows')).length==0) {
               $.pjax.reload({container:'#pjax_consultas'}); 
            }
            else {
                //despues de que seleccionen algo, se refresca si pasan 10 min
                setTimeout(function(){
                     $.pjax.reload({container:'#pjax_consultas'}); 
                 },300000);
            }
            
        }, 20000);
    });"
);

LibretasAsset::register($this);

$this->title = 'Atención Consulta Médica';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <?php  echo $this->render('_search3', ['model' => $searchModel]); ?>

<?php $form = ActiveForm::begin(['method' => 'post', 'id' => 'formPool']); ?>    

<div class="col-md-offset-10">
    <button class="btn btn-primary pull-right" type="button" onclick="registrarAtencion();">Registrar Atención</button>    

</div>
<br>
<?php Pjax::begin(['id'=>'pjax_consultas']) ?>    
<?= GridView::widget([
        'id'=> 'gridCons',
        'dataProvider' => $dataProvider,
                     
        'columns' => [
           
            'LI_NRO',
            'LI_FECPED:date',
            //'LI_HORA',
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
           ['class' => 'yii\grid\CheckboxColumn'],
        ],
    ]); ?>
        
<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?>
</div>
