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
use documento_salud\models\Doclab;

/* @var $this yii\web\View */
/* @var $searchModel documento_salud\models\LibretasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJs(
   "$('document').ready(function(){ 
        //actualiza la pagina si no hay filas seleccionadas
        setInterval(function(){
            if( ($('#gridCons').yiiGridView('getSelectedRows')).length==0) {
               $.pjax.reload({container:'#pjax_con'}); 
            }
            else {
                //despues de que seleccionen algo, se refresca si pasan 10 min
                setTimeout(function(){
                     $.pjax.reload({container:'#pjax_con'}); 
                 },300000);
            }
            
        }, 20000);
    });"
);

LibretasAsset::register($this);

$this->title = 'Consulta Médico';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libretas-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <?php  echo $this->render('_searchconsulta', ['model' => $searchModel]); ?>

<?php $form = ActiveForm::begin(['method' => 'post', 'id' => 'formPool']); ?>    


<br>
<?php Pjax::begin(['id'=>'pjax_con']) ?>    
<?= GridView::widget([
        'id'=> 'gridCons',
        'dataProvider' => $dataProvider,
        'columns' => [
           
            'LI_NRO',
            [
                'attribute' => 'LI_COCLI',
                'label' => 'Tipo Doc.',
                'value' => 'lICOCLI.CL_TIPDOC'
            ],
           [
                'attribute' => 'LI_COCLI',
                'label' => 'N° Doc.',
                'value' => 'lICOCLI.CL_NUMDOC'
            ],
            [
                'attribute' => 'LI_COCLI',
                'label' => 'Apellido y Nombre',
                'value' => 'lICOCLI.CL_APENOM'
            ],
            'LI_COCLI',
            'LI_FECPED:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => ' {form1} {form2} {form3}',
                'buttons' => [
                   'form1' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['/doclab/create', 'id' => $model->LI_NRO], 
                            ['title' => 'Editar Documento Laboral',
                                'class' => 'botonAction']
                                ); 
                    },
                    'form2' => function ($url, $model) {
                        if (Doclab::findOne($model->LI_NRO)) {

                            $clase= 'botonAction';
                        }
                        else {
                            $clase= 'disabled botonAction'; 
                        }
                         return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                ['doclab/view', 'id' => $model->LI_NRO], 
                                ['title' => 'Ver Documento Laboral',
                                    'class' => $clase]);

                        },
                    'form3' => function ($url, $model) {
                        return Html::a(
                                '<span class="glyphicon glyphicon-folder-open"></span>',
                                ['doclab/view-edit-hist', 'id' => $model->LI_NRO], 
                                ['title' => 'Ver Actuaciones previas / Editar Actuación',
                                    'class' => 'botonAction']);

                        },
                                     
                    ],
                ],
            ],
    ]); ?>
        
<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?>
</div>
